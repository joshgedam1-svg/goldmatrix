<?php
namespace App\Controllers\Admin;

use App\Services\Database;

class LeadsController {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /* ── CONTACT ENQUIRIES ── */
    public function index(): void {
        $status = $_GET['status'] ?? '';
        $search = trim($_GET['q'] ?? '');

        // Auto mark as read if clicked from notification
        if (!empty($_GET['read_id'])) {
            $readId = (int)$_GET['read_id'];
            $this->db->query("UPDATE leads SET status = 'contacted' WHERE id = ? AND status = 'new'", [$readId]);
        }

        // Handle status update
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' || !empty($_GET['action'])) {
            $action = $_POST['action'] ?? $_GET['action'] ?? '';
            if ($action === 'mark_all_read') {
                $this->db->query("UPDATE leads SET status = 'contacted' WHERE status = 'new'");
                $this->db->query("UPDATE demo_requests SET status = 'contacted' WHERE status = 'new'");
                set_flash('success', 'All notifications marked as read.');
                redirect($_SERVER['HTTP_REFERER'] ?? '/admin/leads');
                return;
            }
            if ($action === 'update_status') {
                $id        = (int)($_POST['lead_id'] ?? 0);
                $newStatus = $_POST['status'] ?? 'new';
                $allowed   = ['new','contacted','qualified','demo_scheduled','converted','lost'];
                if (in_array($newStatus, $allowed)) {
                    $this->db->query("UPDATE leads SET status = ? WHERE id = ?", [$newStatus, $id]);
                }
                set_flash('success', 'Lead status updated successfully.');
                redirect('/admin/leads' . ($status ? '?status='.$status : ''));
                return;
            }
            if ($action === 'delete') {
                $id = (int)($_POST['lead_id'] ?? 0);
                $this->db->query("DELETE FROM leads WHERE id = ?", [$id]);
                set_flash('success', 'Lead deleted successfully.');
                redirect('/admin/leads');
                return;
            }
        }

        // Build query
        $where = '1=1';
        $params = [];
        if ($status) { $where .= ' AND status = ?'; $params[] = $status; }
        if ($search) { $where .= ' AND (name LIKE ? OR email LIKE ? OR company LIKE ?)'; $params = array_merge($params, ["%$search%","%$search%","%$search%"]); }

        $leads = $this->db->fetchAll("SELECT * FROM leads WHERE $where ORDER BY created_at DESC LIMIT 100", $params);
        $counts = [
            'all'            => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM leads"),
            'new'            => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM leads WHERE status='new'"),
            'contacted'      => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM leads WHERE status='contacted'"),
            'converted'      => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM leads WHERE status='converted'"),
        ];

        admin_view('admin.leads.index', [
            'title'   => 'Contact Enquiries',
            'leads'   => $leads,
            'counts'  => $counts,
            'status'  => $status,
            'search'  => $search,
        ]);
    }

    /* ── DEMO REQUESTS ── */
    public function demos(): void {
        // Auto mark as read if clicked from notification
        if (!empty($_GET['read_id'])) {
            $readId = (int)$_GET['read_id'];
            $this->db->query("UPDATE demo_requests SET status = 'contacted' WHERE id = ? AND status = 'new'", [$readId]);
        }
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'update_status') {
                $id        = (int)($_POST['demo_id'] ?? 0);
                $newStatus = $_POST['status'] ?? 'new';
                $this->db->query("UPDATE demo_requests SET status = ? WHERE id = ?", [$newStatus, $id]);
                set_flash('success', 'Demo status updated successfully.');
                redirect('/admin/demo-requests');
                return;
            }
        }

        $demos = $this->db->fetchAll("SELECT * FROM demo_requests ORDER BY created_at DESC LIMIT 100");

        admin_view('admin.leads.demos', [
            'title' => 'Demo Requests',
            'demos' => $demos,
        ]);
    }

    /* ── AJAX NOTIFICATION API ENDPOINTS ── */
    public function apiMarkAllRead(): void {
        header('Content-Type: application/json');
        try {
            $this->db->query("UPDATE leads SET status = 'contacted' WHERE status = 'new'");
            $this->db->query("UPDATE demo_requests SET status = 'contacted' WHERE status = 'new'");
            echo json_encode(['success' => true]);
        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

    public function apiMarkSingleRead(): void {
        header('Content-Type: application/json');
        $type = $_POST['type'] ?? 'lead';
        $id = (int)($_POST['id'] ?? 0);
        try {
            if ($type === 'demo') {
                $this->db->query("UPDATE demo_requests SET status = 'contacted' WHERE id = ? AND status = 'new'", [$id]);
            } else {
                $this->db->query("UPDATE leads SET status = 'contacted' WHERE id = ? AND status = 'new'", [$id]);
            }
            echo json_encode(['success' => true]);
        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

    public function apiUpdateStatus(): void {
        header('Content-Type: application/json');
        $type = $_POST['type'] ?? 'lead';
        $id = (int)($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'contacted';
        try {
            if ($type === 'demo') {
                $this->db->query("UPDATE demo_requests SET status = ? WHERE id = ?", [$status, $id]);
            } else {
                $this->db->query("UPDATE leads SET status = ? WHERE id = ?", [$status, $id]);
            }
            echo json_encode(['success' => true]);
        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }
}
