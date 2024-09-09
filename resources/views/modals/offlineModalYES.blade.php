@section('offlineModalYES')
<div class="modal" id="offlineModalYES" style="display: none;">
    <div class="modal__body">
        <div class="alert alert-danger" id="modal-errors" style="display: none;">
            <ul id="error-list"></ul>
        </div>
        <span class="close-modal"><svg width="20" height="20"
            viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M19.1814 3.00048C19.7139 2.46795 19.7139 1.60454 19.1814 1.07201C18.6488 0.539475 17.7854 0.539474 17.2529 1.07201L9.97405 8.35085L2.75756 1.13436C2.22503 0.601825 1.36162 0.601825 0.829088 1.13436C0.296555 1.66689 0.296554 2.5303 0.829087 3.06283L8.04558 10.2793L1.39244 16.9325C0.859906 17.465 0.859906 18.3284 1.39244 18.8609C1.92497 19.3935 2.78838 19.3935 3.32091 18.8609L9.97405 12.2078L16.6895 18.9233C17.2221 19.4558 18.0855 19.4558 18.618 18.9233C19.1505 18.3907 19.1505 17.5273 18.618 16.9948L11.9025 10.2793L19.1814 3.00048Z"
                fill="#2F2F37" />
        </svg>
    </span> 
        <div class="modal__form offlineModal">
          <form  > 
                @csrf
                <h6 class="tt">Твоя заявка принята</h6>
                <p>Мы вышлем подробную информацию на твою почту</p>
            </form>
            <label for="" class="yes__button__no">
                <button onclick="" class="close-modal" >{{ __('На главную') }}</button>
              
            </label>
        </div>
    </div>
</div>

@endsection