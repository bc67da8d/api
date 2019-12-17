Như bạn biết thì khi sử dụng REST API thì khái niệm session không còn tồn tại nữa, vậy làm 
thế nào để chứng thực người dùng, hoặc bảo vệ REST API thì chúng ta phải dùng một công nghệ
mới, trong video này chúng tôi sẽ hướng dẫn dùng JWT 

JWT là một phương tiện đại diện cho các yêu cầu chuyển giao giữa hai bên Client – Server ,
các thông tin trong chuỗi JWT được định dạng bằng JSON . 
Trong đó chuỗi Token phải có 3 phần:

- header 
- payload 
- signature

Phần header sẽ chứa kiểu dữ liệu , và thuật toán sử dụng để mã hóa ra chuỗi JWT

```angular2
{
    "typ": "JWT",
    "alg": "HS256"
}
```
“typ” (type) chỉ ra rằng đối tượng là một JWT
“alg” (algorithm) xác định thuật toán mã hóa cho chuỗi là HS256

Phần payload sẽ chứa các thông tin mình muốn đặt trong chuỗi  Token như
username , userId , author , … ví dụ:

Signature

Phần chử ký này sẽ được tạo ra bằng cách mã hóa phần header , 
payload kèm theo một chuỗi secret (khóa bí mật) , ví dụ: