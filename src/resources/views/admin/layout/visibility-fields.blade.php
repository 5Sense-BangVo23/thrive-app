<style>

.visibility-fields {
    max-width: 320px;            /* Giới hạn chiều rộng tổng thể */
    margin: 20px auto;           /* Căn giữa khối form trên trang */
    padding: 15px 20px;          /* Padding bên trong để tránh sát viền */
    background-color: #fafafa;   /* Nền nhẹ, sáng hơn trắng */
    border: 1.5px solid #e1bee7; /* Viền màu tím nhạt */
    border-radius: 8px;          /* Bo góc mềm mại */
    box-shadow: 0 2px 8px rgba(156, 39, 176, 0.1); /* Đổ bóng nhẹ tạo chiều sâu */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}


/* Container dropdown */
.dropdown-checkbox {
  position: relative;
  width: 280px;
  user-select: none;
  font-family: inherit;
}

/* Button hiển thị và mở dropdown */
.dropdown-checkbox__button {
  width: 100%;
  padding: 8px 12px;
  border: 1.5px solid #9c27b0;
  border-radius: 6px;
  background-color: #fff;
  cursor: pointer;
  font-size: 14px;
  color: #444;
  text-align: left;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.dropdown-checkbox__button:focus {
  outline: none;
  border-color: #7b1fa2;
  box-shadow: 0 0 5px rgba(123, 31, 162, 0.4);
}

/* Phần dropdown list */
.dropdown-checkbox__list {
  position: absolute;
  width: 100%;
  max-height: 180px;
  overflow-y: auto;
  border: 1.5px solid #9c27b0;
  border-radius: 6px;
  background: #fff;
  margin-top: 4px;
  box-shadow: 0 2px 6px rgba(156, 39, 176, 0.15);
  display: none; /* Ẩn mặc định */
  z-index: 100;
}

/* Hiện dropdown */
.dropdown-checkbox__list.show {
  display: block;
}

/* Mỗi option checkbox */
.dropdown-checkbox__option {
  padding: 6px 10px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
}

.dropdown-checkbox__option:hover {
  background-color: #f3e5f5;
  color: #7b1fa2;
}


.form__button-submit {
    margin-top: 15px;
    background-color: #9c27b0;
    border: 1.5px solid #9c27b0;
    color: #fff;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    font-size: 15px;
    user-select: none;
    display: inline-block;
    text-align: center;
}

.form__button-submit:hover,
.form__button-submit:focus {
    background-color: #7b1fa2;
    border-color: #7b1fa2;
    outline: none;
    box-shadow: 0 0 6px rgba(123, 31, 162, 0.5);
}

</style>

<div class="visibility-fields">
  <form action="{{ route('admin.categories.visibility') }}" method="POST">
    @csrf

    <label for="fields-dropdown" class="form__label">Select Visible Fields:</label>

    <div class="dropdown-checkbox" id="fields-dropdown">
      <button type="button" class="dropdown-checkbox__button" aria-haspopup="listbox" aria-expanded="false">
        Select fields...
        <span>▼</span>
      </button>
      <div class="dropdown-checkbox__list" role="listbox" tabindex="-1">
        @foreach ($fields as $field)
        <label class="dropdown-checkbox__option">
          <input 
            type="checkbox" 
            name="fields[]" 
            value="{{ $field }}" 
            @if(is_array($visibleFields) && in_array($field, $visibleFields)) checked @endif
          >
          {{ ucfirst($field) }}
        </label>
        @endforeach
      </div>
    </div>

    <button type="submit" class="form__button-submit">Update Visibility</button>
  </form>
</div>

<script>
// JS để bật tắt dropdown và cập nhật button text
document.addEventListener('DOMContentLoaded', function() {
  const dropdown = document.getElementById('fields-dropdown');
  const button = dropdown.querySelector('.dropdown-checkbox__button');
  const list = dropdown.querySelector('.dropdown-checkbox__list');
  const checkboxes = list.querySelectorAll('input[type="checkbox"]');

  // Toggle dropdown hiển thị
  button.addEventListener('click', () => {
    const expanded = button.getAttribute('aria-expanded') === 'true';
    button.setAttribute('aria-expanded', !expanded);
    list.classList.toggle('show');
  });

  // Click ngoài dropdown sẽ đóng dropdown
  document.addEventListener('click', e => {
    if (!dropdown.contains(e.target)) {
      list.classList.remove('show');
      button.setAttribute('aria-expanded', false);
    }
  });

  // Cập nhật text button dựa trên checkbox đã chọn
  function updateButtonLabel() {
    const checked = [...checkboxes].filter(cb => cb.checked).map(cb => cb.parentNode.textContent.trim());
    if (checked.length === 0) {
      button.firstChild.textContent = 'Select fields...';
    } else {
      button.firstChild.textContent = checked.join(', ');
    }
  }

  checkboxes.forEach(cb => {
    cb.addEventListener('change', updateButtonLabel);
  });

  // Khởi tạo label button ban đầu
  updateButtonLabel();
});
</script>
