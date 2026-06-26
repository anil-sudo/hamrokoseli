<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Hamrokoseli</title>
    <style>
        :root {
            --primary-color: #1F3D2E;
            --secondary-color: #C65A3A;
            --text-color: #3A2A1F;
            --text-light: #FFF7EF;
            --text-dark: #1F2A24;
            --bg-color: #F5E8D6;
            --card-bg: #FFF7EF;
            --hover-color: #D4A017;
        }
        
        body {
            margin: 0;
            padding: 0;
            background-color: #F5E8D6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #3A2A1F;
            line-height: 1.6;
        }
        
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #FFF7EF;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(31, 61, 46, 0.15);
        }
        
        .header {
            background: linear-gradient(135deg, #1F3D2E, #2A5A44);
            color: #FFF7EF;
            padding: 35px 40px;
            text-align: center;
        }
        
        .logo {
            font-size: 36px;
            margin-bottom: 8px;
        }
        
        .content {
            padding: 40px;
        }
        
        .greeting {
            font-size: 22px;
            color: #1F3D2E;
            margin-bottom: 15px;
        }
        
        .card {
            background-color: #FFF7EF;
            border: 1px solid #EDE0D0;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }
        
        .info-label {
            font-weight: 600;
            width: 160px;
            color: #1F3D2E;
        }
        
        .info-value {
            flex: 1;
            color: #3A2A1F;
        }
        
        .status-badge {
            display: inline-block;
            background-color: #F5E8D6;
            color: #C65A3A;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
        }
        
        .btn {
            display: inline-block;
            background-color: #C65A3A;
            color: #FFF7EF;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 10px 5px;
        }
        
        .btn:hover {
            background-color: #D4A017;
            color: #1F3D2E;
        }
        
        .footer {
            background-color: #1F3D2E;
            color: #FFF7EF;
            text-align: center;
            padding: 30px 20px;
            font-size: 14px;
        }
        
        @media only screen and (max-width: 600px) {
            .container { margin: 10px; border-radius: 8px; }
            .content { padding: 25px; }
            .info-label { width: 100%; margin-bottom: 5px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">🛍️</div>
            <h1>Hamrokoseli</h1>
            <p style="margin: 10px 0 0; opacity: 0.95;">Welcome to Our Platform!</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <p class="greeting">Dear {{ $vendor->owner_name ?? $vendor->user->name }},</p>
            
            <p>Thank you for registering as a vendor on <strong>Hamrokoseli</strong>. Your application has been received successfully.</p>
            
            <div class="card">
                <h2 style="margin-top: 0; color: #1F3D2E; border-bottom: 2px solid #C65A3A; padding-bottom: 12px;">
                    Registration Summary
                </h2>
                
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="info-label">Vendor Name:</td>
                        <td class="info-value"><strong>{{ $vendor->vendor_name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="info-label">Owner Name:</td>
                        <td class="info-value">{{ $vendor->owner_name }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Vendor Email:</td>
                        <td class="info-value">{{ $vendor->email }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Vendor Phone:</td>
                        <td class="info-value">{{ $vendor->phone }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">City / Province:</td>
                        <td class="info-value">
                            {{ $vendor->city ?? 'N/A' }} {{ $vendor->province ? ', '.$vendor->province : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="info-label">PAN Number:</td>
                        <td class="info-value">{{ $vendor->pan_number ?? 'Not provided' }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Status:</td>
                        <td class="info-value">
                            <span class="status-badge">PENDING APPROVAL</span>
                        </td>
                    </tr>
                </table>
            </div>
            
            <p><strong>What happens next?</strong></p>
            <ul>
                <li>Our team will review your application within 1-2 business days.</li>
                <li>You will receive another email once your vendor account is approved.</li>
                <li>After approval, you can log in and start adding your products.</li>
            </ul>
            
            <div style="text-align: center; margin: 35px 0;">
                <a href="{{config('app.url').'/admin/vendors/' . $vendor->id . '/edit') }}" class="btn" target="_blank">
                        Go to Vendor Login
                    </a>
            </div>
            
            <p>If you have any questions, feel free to reply to this email or contact our support team.</p>
            
            <p>Thank you for choosing Hamrokoseli!<br>
            We look forward to growing together.</p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>Hamrokoseli</strong> - Supporting Local Businesses of Nepal</p>
            <p>This is an automated email. Please do not reply to this address.</p>
            <p>&copy; {{ date('Y') }} Hamrokoseli. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>