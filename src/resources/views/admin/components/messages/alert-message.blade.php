<style>
  #flash-message {
    position: fixed;
    top: 20px;
    right: 20px;
    min-width: 280px;
    max-width: 400px;
    padding: 12px 20px 28px; /* thêm padding-bottom cho progress bar */
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 1rem;
    line-height: 1.4;
    color: #fff;
    z-index: 1050;
  }

  /* Gradient background cho từng loại alert */
  .alert-success {
    background: linear-gradient(135deg, #0ecd3a 0%, #8ee8a1 100%);
    color: #fff;
  }

  .alert-danger {
    background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%);
    color: #fff;
  }

  .alert-warning {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    color: #212529;
  }

  .alert-info {
    background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
    color: #fff;
  }

  /* Nút đóng */
  #flash-message .btn-close {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 22px;
    height: 22px;
    opacity: 0.7;
    transition: opacity 0.3s ease;
    cursor: pointer;
  }
  #flash-message .btn-close:hover {
    opacity: 1;
  }

  /* Hiệu ứng fade out */
  #flash-message.fade-out {
    opacity: 0;
    transition: opacity 0.5s ease;
  }

  /* Thanh tiến trình timeout */
  #flash-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.7);
    border-radius: 0 0 8px 8px;
    animation-name: progressbar;
    animation-timing-function: linear;
    animation-fill-mode: forwards;
  }

  @keyframes progressbar {
    from { width: 100%; }
    to { width: 0%; }
  }

  /* Responsive */
  @media (max-width: 576px) {
    #flash-message {
      left: 10px;
      right: 10px;
      top: 10px;
      min-width: auto;
      max-width: none;
      font-size: 0.9rem;
      padding-bottom: 28px;
    }
  }
</style>

<div id="flash-message"
     class="alert alert-{{ $type }} alert-dismissible fade show"
     role="alert"
     data-time="{{ $time ?? '' }}">
  {{ $message }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <div id="flash-progress"></div>
</div>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    const flashMessage = document.getElementById('flash-message');
    const flashProgress = document.getElementById('flash-progress');
    if (!flashMessage || !flashProgress) return;

    const messageTime = parseInt(flashMessage.dataset.time, 10);
    if (isNaN(messageTime)) return;

    const now = Math.floor(Date.now() / 1000);
    const diff = now - messageTime;

    const totalDuration = 5000; 
    const remaining = totalDuration - diff * 1000;

    if (diff > 5) {
      flashMessage.style.display = 'none';
      return;
    }

    flashProgress.style.animationDuration = `${remaining}ms`;
    setTimeout(() => {
      flashMessage.classList.add('fade-out');
      setTimeout(() => flashMessage.remove(), 500);
    }, remaining);
  });
</script>
