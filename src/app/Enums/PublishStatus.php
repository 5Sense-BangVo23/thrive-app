<?php

namespace App\Enums;

enum PublishStatus: string
{
    case Draft = 'draft';         // Chưa công khai
    case Published = 'published'; // Đã sẵn sàng/đã hiển thị
    case Archived = 'archived';   // Ẩn khỏi hệ thống nhưng chưa xoá

    public function label(): string
    {
        return match ($this) {
            self::Draft     => 'Draft (Not Published)',
            self::Published => 'Published (Visible)',
            self::Archived  => 'Archived (Hidden)',
        };
    }


    public function color(): string
    {
        return match ($this) {
            self::Draft     => 'secondary',  // xám
            self::Published => 'success',    // xanh lá
            self::Archived  => 'warning',    // cam
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Draft     => '🛠️', // Đang chỉnh sửa
            self::Published => '💅', // Dịch vụ sẵn sàng
            self::Archived  => '📦', // Đã lưu trữ
        };
    }

    public static function options(): array
    {
        return array_map(fn ($status) => [
            'value' => $status->value,
            'label' => $status->label(),
            'color' => $status->color(),
            'icon'  => $status->icon(),
        ], self::cases());
    }
}
