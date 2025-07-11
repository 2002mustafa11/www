<div>
    <span class="badge bg-{{ $status == 'completed' ? 'success' : ($status == 'rejected' ? 'danger' : 'warning') }}">
        {{ $status == 'completed' ? 'مكتملة' : ($status == 'rejected' ? 'مرفوضة' : 'قيد الانتظار') }}
    </span>

    <select wire:model="status" wire:change="updateStatus" class="form-select form-select-sm">
        <option value="pending">قيد الانتظار</option>
        <option value="completed">مكتملة</option>
        <option value="rejected">مرفوضة</option>
    </select>

    @if (session()->has('message'))
        <div class="alert alert-success mt-2">{{ session('message') }}</div>
    @endif
</div>

