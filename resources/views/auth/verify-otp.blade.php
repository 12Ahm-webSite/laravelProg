@extends('layouts.app')
@section('title', 'استعادة كلمة المرور')

@section('content')
<main class="desktop-twentyone-main">
    <section>
        <div class="container">
            <div class="twentyone-main-wrpper">
                <h3>
                    تم إرسال كود استعادة كلمة المرور إلى بريدك
                    الإلكتروني / رقم جوالك
                </h3>
                <h3>تحقق منه لتغيير كلمة المرور</h3>

                <form method="POST" action="{{ route('otp.verify') }}">
                    @csrf
                    <div class="otp-parent" dir="ltr">
                        <div class="otp-container">
                            <input type="text" maxlength="1" class="otp-input" name="otp[]" required />
                            <input type="text" maxlength="1" class="otp-input" name="otp[]" required />
                            <input type="text" maxlength="1" class="otp-input" name="otp[]" required />
                            <input type="text" maxlength="1" class="otp-input" name="otp[]" required />
                        </div>
                    </div>
                    <button type="submit" class="btn">تحقق</button>
                </form>

                <p>إعادة إرسال الرابط إذا لم يصل</p>
            </div>
        </div>
    </section>
</main>

<!-- OTP input Handler -->
<script>
    const inputs = document.querySelectorAll(".otp-input");

    inputs.forEach((input, index) => {
        input.addEventListener("input", () => {
            if (input.value) {
                input.classList.add("filled");
                if (index < inputs.length - 1) {
                    inputs[index + 1].focus();
                } else {
                    input.blur();
                }
            } else {
                input.classList.remove("filled");
            }
        });

        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });
</script>
@endsection


