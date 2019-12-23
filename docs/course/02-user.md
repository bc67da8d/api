Chào mừng bạn đến bài học đầu tiên trong khoá học xây dựng REST API trên nền tảng PhalconPHP của Gsviec.

Để xây dựng một ứng dụng mạng xã hội thú cưng, thì việc đầu tiên đó là tạo users. Trước tiên bạn hãy mở PHPMyadmin lên để tạo cơ sỏ dữ liệu cho nó.

Một khi chúng ta có table users rồi, thì việc kế đến là chúng ta sẽ định nghĩa nó trong code, mà cụ thể nó là phần model trong Phalcon PHP nếu bạn nào chưa hiểu model là gì thì có thể xem lại khoá học căn bản PhalconPHP trên gsviec.

Chúng ta sẽ định nghĩa một router api cho users như sau, bạn mở file app.php lên:

- GET: /users/{id} (lấy thông tin user)
- POST: /users (tạo một user)
- DELETE: /users/{id} (xoá một user)
- PUT: /users/{id} 

Ở đây chúng tôi sữ dụng Micro Collection để làm code clean hơn và dễ quản lý sau này, tất nhiên bạn cũng có thể chèn trực tiếp trong file app.php, nhưng chúng tôi khuyên bạn không nên làm thế.

Tiếp tục chúng tôi sẽ tạo một Controller Users để xữ lý request từ người dùng
