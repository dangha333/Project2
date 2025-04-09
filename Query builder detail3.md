## Raw Expressions trong Laravel là gì?

Raw Expressions trong Laravel cho phép bạn viết câu lệnh SQL thô trực tiếp trong các truy vấn của Query Builder. Điều này rất hữu ích khi bạn cần thực hiện những thao tác phức tạp hoặc tùy chỉnh mà Query Builder không hỗ trợ trực tiếp.

`DB::raw('câu lệnh SQL');`

**Ví dụ:**

```php
$users = DB::table('users')
    ->select(DB::raw('count(*) as user_count, status'))
    ->where('status', '<>', 1)
    ->groupBy('status')
    ->get();

```

**Giải thích**

1. select(DB::raw(...)): Chọn cột và thực hiện phép tính SQL.
   - count(\*) as user_count: Đếm số lượng người dùng và gán bí danh (user_count).
   - status: Lấy thêm cột trạng thái.
2. where('status', '<>', 1): Lọc những bản ghi có trạng thái khác 1.
3. groupBy('status'): Nhóm kết quả theo trạng thái.
4. get(): Lấy tất cả kết quả trả về dưới dạng Collection.

**Câu lệch SQL tương đương**

```php
SELECT COUNT(*) AS user_count, status
FROM users
WHERE status <> 1
GROUP BY status;

```

Ví dụ: Dữ liệu

| **id** | **name** | **status** |
| ------ | -------- | ---------- |
| 1      | Alice    | 0          |
| 2      | Bob      | 2          |
| 3      | Charlie  | 2          |
| 4      | David    | 0          |
| 5      | Eve      | 1          |

Kết quả truy vấn:

```php
[
    (object) ['user_count' => 2, 'status' => 0],
    (object) ['user_count' => 2, 'status' => 2]
]

```

Ý nghĩa:

- 2 người dùng có status = 0
- 2 người dùng có status = 2
- status = 1 bị loại bỏ do điều kiện where('status', '<>', 1).

**Khi nào nên sử dụng DB::raw()?**

1. Khi cần dùng các hàm SQL đặc biệt (ví dụ: SUM(), COUNT(), AVG(), NOW(), v.v.).
2. Khi Query Builder không hỗ trợ trực tiếp cú pháp mong muốn.
3. Khi cần tối ưu hiệu suất hoặc xử lý phức tạp trong câu lệnh SQL.

Ví dụ:

```php
// Tính tổng doanh thu:
$sales = DB::table('orders')
    ->select(DB::raw('SUM(amount) as total_sales'))
    ->where('status', 'completed')
    ->first();

echo $sales->total_sales;



// Tính tuổi từ ngày sinh (DATEDIFF()):
$users = DB::table('users')
    ->select('name', DB::raw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) as age'))
    ->get();


// Lấy bản ghi ngẫu nhiên (RAND())
$randomUser = DB::table('users')
    ->select('name')
    ->orderBy(DB::raw('RAND()'))
    ->first();

echo $randomUser->name;

```

Lưu ý: Luôn ưu tiên Query Builder, chỉ những trường hợp nào thực sự phức tạp mới sử dụng DB:raw() để tránh tối đa lỗi bảo mật SQL injection.
Đối với những hàm SUM(), COUNT(), AVG(), NOW(),... bản thân query builder đã có những hàm được tối ưu sẵn
