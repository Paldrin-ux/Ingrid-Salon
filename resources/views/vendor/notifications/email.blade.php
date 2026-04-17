<x-mail::message>
# 💇‍♀️ Ingrid Salon

Hello {{ $user->name ?? 'Valued Client' }},

We received a request to reset your password for your **Ingrid Salon** account.

@isset($actionText)
<x-mail::button :url="$actionUrl" color="primary">
{{ $actionText }}
</x-mail::button>
@endisset

This password reset link will expire in **60 minutes**.

If you did not request a password reset, please ignore this email — your account is safe.

Thank you for being part of **Ingrid Salon**!  
We look forward to seeing you soon 💖

---

If you're having trouble clicking the "Reset Password" button, copy and paste this link into your browser:  
[{{ $actionUrl }}]({{ $actionUrl }})

With love,  
**Ingrid Salon Team**
</x-mail::message>
