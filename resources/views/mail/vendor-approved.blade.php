@component('mail::message')

# 🎉 Congratulations!

**Dear {{ $vendor->owner_name ?? $vendor->user->name }},**

Your vendor application has been **successfully approved** by our team.

You can now start listing your products on **Hamrokoseli** and reach thousands of customers.

---

### Vendor Account Details

**Vendor Name:** {{ $vendor->vendor_name }}
**Owner Name:** {{ $vendor->owner_name }}
**Email:** {{ $vendor->email }}
**Phone:** {{ $vendor->phone }}
**City:** {{ $vendor->city }}
**Province:** {{ $vendor->province }}
**Status:** <span style="color: #1F3D2E; font-weight: bold;">Active</span>

---

### What You Can Do Now:

- Log in to your vendor dashboard
- Add your products with images, prices & descriptions
- Manage orders and track earnings
- Promote your shop

@component('mail::button', ['url' => config('app.url') . '/seller-login'])
Go to Vendor Dashboard
@endcomponent

---

If you need any help getting started, feel free to reply to this email or contact our support team.

We are excited to have you as part of the **Hamrokoseli** family! 🌱

**Thank you for choosing us.**

Best Regards,
**Hamrokoseli Team**

@endcomponent
