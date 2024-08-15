<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Notification</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }
    .container {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 0 auto;
    }
    .header {
      font-size: 24px;
      font-weight: 700;
      color: #333333;
      margin-bottom: 20px;
    }
    .content {
      font-size: 16px;
      color: #555555;
    }
    .content p {
      margin: 10px 0;
    }
    .content span {
      font-weight: 900;
      color: #333333;
    }
    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    .table th, .table td {
      padding: 15px;
      border: 1px solid #dddddd;
      text-align: left;
      font-size: 16px;
      color: #333333;
    }
    .table th {
      background-color: #f8f8f8;
      font-weight: 700;
    }
    .table td b {
      color: #333333;
    }
  </style>
</head>
@php
  $general_configuration = DB::table('general_configurations')->first();
@endphp

<body>
  <div class="container">
    <div class="header">Contact Form Submission</div>
    <div class="content">
      <p>Dear <span>Admin</span>,</p>
      <p>A contact message was sent by <b>{{ $fullName }}</b> via {{ $general_configuration->brand_name }} website.</p>
      <table class="table">
        <tr>
          <th>Full Name</th>
          <td><b>{{ $fullName }}</b></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><b>{{ $email }}</b></td>
        </tr>
        <tr>
          <th>Phone</th>
          <td><b>{{ $phone }}</b></td>
        </tr>
        <tr>
          <th>Message</th>
          <td><b>{{ $message }}</b></td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>
