<?php
// Optionally include the Controller.php file (if not autoloaded)
require_once ROOT . '/app/core/Controller.php';
require_once ROOT . '/app/models/Order.php';
class OrderController extends Controller
{

    private $orderModel;

    public function __construct()
    {

        $this->orderModel = new Order();

        $this->base_url = BASE_URL;
        session_start();
        // Ensure the user is logged in
        if (!isset($_SESSION['user_access_id'])) {
            // Redirect to login page if not logged in
            header("Location: " . BASE_URL . "backend/auth/login");
            exit();
        }
    }
    public function details($ordercode)
    {
        // Fetch the order details by ordercode
        $order = $this->orderModel->getOrderByOrderCodeAndInfoCustomer($ordercode);

        // Check if the order exists and belongs to the logged-in customer
        if ($order) {
            // Pass the order details to the view
            $data = ['order' => $order];
            $content = $this->view('backend/order/details', $data, true);

            // Display the page using the frontend layout
            $this->view('layouts/backend_layout', [
                'content' => $content,
                'title' => 'Order Details',

            ]);
        } else {
            // Order not found or access denied
            header("Location: " . BASE_URL . "backend/order/index");
            exit();
        }
    }
    public function index()
    {


        $orders = $this->orderModel->getOrders();

        // Pass the orders to the view
        $data = [
            'orders' => $orders,

        ];
        $content = $this->view('backend/order/history', $data, true);

        // Display the page using the frontend layout
        $this->view('layouts/backend_layout', [
            'content' => $content,
            'title' => 'Order History'
        ]);
    }
    public function updateOrderStatus()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ordercode = $_POST['ordercode'];
        $status = $_POST['status'];

        // Kiểm tra giá trị hợp lệ (bao gồm 3 trạng thái: 1, 2, 3)
        if ($ordercode && in_array($status, [1, 2, 3])) {
            // Cập nhật tình trạng đơn hàng
            $result = $this->orderModel->updateOrderStatus($ordercode, $status);

            if ($result) {
                // Nếu trạng thái là "Đã hủy", thực hiện thêm logic nếu cần
                if ($status == 3) {
                    // Ví dụ: Xử lý hoàn trả tiền, cập nhật thống kê, v.v. (nếu cần)
                }

                // Chuyển hướng sau khi cập nhật thành công
                header("Location: " . BASE_URL . "backend/order/details/$ordercode?success=Status updated.");
                exit();
            } else {
                header("Location: " . BASE_URL . "backend/order/details/$ordercode?error=Failed to update status.");
                exit();
            }
        } else {
            header("Location: " . BASE_URL . "backend/order/details/$ordercode?error=Invalid input.");
            exit();
        }
    }
}

    public function getOrderStatistics()
    {
        $orders = $this->orderModel->getOrderStatistics();
    }

    public function orderedit($ordercode)
{
    // Lấy dữ liệu đơn hàng từ database
    $order = $this->orderModel->getOrderByOrderCode($ordercode);

    if (!$order) {
        // Nếu không tìm thấy đơn hàng, hiển thị lỗi 404
        header("HTTP/1.0 404 Not Found");
        echo "Đơn hàng không tồn tại.";
        exit();
    }

    // Hiển thị giao diện sửa đơn hàng
    $content = $this->view('backend/order/orderedit', ['order' => $order], true);
    $this->view('layouts/backend_layout', [
        'content' => $content,
        'title' => 'Sửa đơn hàng',
    ]);
}

public function update()
{
    $ordercode = $this->input->post('ordercode');
    $status = $this->input->post('status');
    $shipping_name = $this->input->post('shipping_name');
    $shipping_address = $this->input->post('shipping_address');
    $shipping_phone = $this->input->post('shipping_phone');

    // Cập nhật dữ liệu đơn hàng
    $this->OrderModel->updateOrder($ordercode, [
        'status' => $status,
        'shipping_name' => $shipping_name,
        'shipping_address' => $shipping_address,
        'shipping_phone' => $shipping_phone,
    ]);

    // Quay lại trang chi tiết đơn hàng
    redirect(BASE_URL . 'backend/order/details/' . $ordercode);
}

public function updateOrder($ordercode, $data)
{
    $this->db->where('ordercode', $ordercode);
    $this->db->update('orders', $data);
}

public function cancelorder()
{
    $ordercode = $_POST['ordercode']; // Lấy mã đơn hàng từ form
    $status = 3; // Trạng thái đơn hàng đã hủy

    // Cập nhật trạng thái đơn hàng
    $result = $this->orderModel->updateOrderafterCancel($ordercode, ['status' => $status]);

    if ($result) {
        // Cập nhật thành công
        header("Location: " . BASE_URL . "backend/order/history?success=Order has been canceled.");
    } else {
        // Cập nhật thất bại
        header("Location: " . BASE_URL . "backend/order/details/$ordercode?error=Failed to cancel order.");
    }
    exit();
}

public function history()
{
    // Lấy danh sách đơn hàng từ model
    $orders = $this->orderModel->getOrders();

    // Truyền dữ liệu đến view
    $data = [
        'orders' => $orders,
    ];

    // Hiển thị giao diện lịch sử đơn hàng
    $content = $this->view('backend/order/history', $data, true);
    $this->view('layouts/backend_layout', [
        'content' => $content,
        'title' => 'Lịch sử đơn hàng',
    ]);
}


}
