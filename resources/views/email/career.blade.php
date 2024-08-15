<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html data-editor-version="2" class="sg-campaigns" xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <style>
        *{
            font-family: 'Calibri';
            font-size: 16px;
        }
        .wrapper{
        width:100%;
        margin:0px 10px;
        padding:20px;
        box-sizing: border-box;
        
        }
        .mail-detail
        {
            line-height: 24px;
        }
        .detail-table
        {
            border-collapse: collapse;
            width: 100%;
        }
        .detail-table td,.detail-table th
        {
            padding:3px;
            padding-left: 15px;
        }
        .detail-table th
        {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 style="font-size: 24px;">Dear Management:</h2>
        <p class="mail-detail">New Job application request from Logon Broadband website has been added. Details mentioned below</p>
            <table border="1" class="detail-table">
               <tbody>
                   <tr>
                       <th>User Name</th>
                       <td>{{$user->name}}</td>
                   </tr>
                   <tr>
                        <th>Email</th>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$user->phone}}</td>
                    </tr>
                    <tr>
                        <th>Applying Date</th>
                        <td>{{$user->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Applying For</th>
                        <td>{{$job_title}}</td>
                    </tr>
               </tbody>
            </table>
    </div>
</body>
</html>