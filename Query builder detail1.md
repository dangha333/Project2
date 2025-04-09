## Chunking Results

Phương thức chunk() trong Laravel được sử dụng để xử lý dữ liệu lớn bằng cách chia nhỏ kết quả thành từng phần nhỏ (chunk) thay vì tải toàn bộ dữ liệu vào bộ nhớ. Điều này giúp tiết kiệm bộ nhớ và tối ưu hiệu suất khi làm việc với số lượng bản ghi lớn từ database.

Cách thức hoạt động:

- Lấy dữ liệu theo từng nhóm (mỗi nhóm n bản ghi).
- Gọi callback function để xử lý từng nhóm.
- Tiếp tục lặp lại cho đến khi hết dữ liệu.

Ví dụ:

```php
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

DB::table('users')->orderBy('id')->chunk(100, function (Collection $users) {
    foreach ($users as $user) {
        echo $user->name . "\n";
    }
});

```

1. orderBy('id'): Sắp xếp kết quả theo id (bắt buộc khi sử dụng chunk() để đảm bảo tính nhất quán).
2. chunk(100, $callback): Lấy 100 bản ghi/lần và truyền vào callback function để xử lý.
3. Lặp lại quá trình này cho đến khi không còn dữ liệu.

Giả sử:
Khi bảng users có 1.000.000 bản ghi, thay vì tải toàn bộ vào bộ nhớ (rất nặng), Laravel sẽ:

- Lấy 100 bản ghi đầu tiên → Gọi callback và xử lý.
- Lấy 100 bản ghi tiếp theo → Gọi callback và xử lý.
- Lặp lại đến khi hết bản ghi.

=> Tiết kiệm bộ nhớ: Không tải tất cả dữ liệu cùng một lúc.
=> Tránh lỗi tràn bộ nhớ (Out Of Memory) khi xử lý dữ liệu lớn.

**Ví dụ khi cập nhật người dùng**
Giả sử bạn muốn cập nhật trạng thái của tất cả người dùng thành "active".

```php
DB::table('users')->orderBy('id')->chunk(200, function ($users) {
    foreach ($users as $user) {
        DB::table('users')->where('id', $user->id)->update(['status' => 'active']);
    }
});

```

**Khi nào nên dùng chunk()?**

- Xử lý tập dữ liệu lớn: Khi bảng chứa hàng chục ngàn hoặc triệu bản ghi.
- Tối ưu hóa vòng lặp cập nhật, tính toán hoặc xóa dữ liệu.
- Tránh lỗi tràn bộ nhớ (Out Of Memory) khi xử lý khối lượng lớn.

## Phân biệt chunk() và chunkById()

- chunk(): Chia theo số lượng bản ghi với điều kiện sắp xếp.
- chunkById(): Chia nhỏ dựa trên id mà không cần sắp xếp thủ công.

```php
DB::table('users')->chunkById(100, function ($users) {
    foreach ($users as $user) {
        echo $user->name;
    }
});

```

Ưu điểm của chunkById():

- Nhanh hơn vì không cần orderBy.
- Ít rủi ro khi dữ liệu thay đổi trong quá trình xử lý.
