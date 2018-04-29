<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Attendance</title>
    <style type="text/css">
      .clearfix:after {
        content: "";
        display: table;
        clear: both;
      }

      a {
        color: #5D6975;
        text-decoration: underline;
      }

      body {
        position: relative;
        width: 21cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #001028;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-family: Arial;
      }

      header {
        padding: 10px 0;
        margin-bottom: 30px;
      }

      #logo {
        text-align: center;
        margin-bottom: 10px;
      }

      #logo img {
        width: 190px;
      }

      h1 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url('/invoice/dimension.png');
      }

      #project {
        float: left;
      }

      #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
      }

      #company {
        float: right;
        text-align: right;
      }

      #project div,
      #company div {
        white-space: nowrap;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
      }

      table tr:nth-child(2n-1) td {
        background: #F5F5F5;
      }

      table th,
      table td {
        text-align: center;
      }

      table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: normal;
      }

      table .service,
      table .desc {
        text-align: left;
      }

      table td {
        padding: 20px;
        text-align: right;
      }

      table td.service,
      table td.desc {
        vertical-align: top;
      }

      table td.unit,
      table td.qty,
      table td.total {
        font-size: 1.2em;
      }

      table td.grand {
        border-top: 1px solid #5D6975;;
      }

      #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
      }

      footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="assets/img/logo.png">
      </div>
      <h1>ATTENDANCE</h1>
      <div id="project">
        <div><span>NAME</span> {{ $child->name }}</div>
        <div><span>DOB</span> {{ $child->dob }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">DATE</th>
            <th class="desc">TIME IN</th>
            <th class="desc">TIME OUT</th>
            <th class="desc">PICK UP BY</th>
            <th class="service">LATE FEE?</th>
          </tr>
        </thead>
        <tbody>
          @foreach($attendance as $attend)
          <tr>
            <td class="service">{{date('jS F Y', strtotime($attend->check_in_date))}}</td>
            <td class="desc">{{date('H:i A', strtotime($attend->check_in_date))}}</td>
            <td class="desc">{{date('H:i A', strtotime($attend->check_out_date))}}</td>
            @if(!is_null($attend->checkOutParent->name))
              <td class="desc">{{$attend->checkOutParent->name }}</td>
            @elseif(!is_null($attend->checkOutPickupUser->name))
              <td class="desc">{{$attend->checkOutPickupUser->name }}</td>
            @else
            <td class="desc"></td>
            @endif
            <td class="service">No</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="4" class="grand total"></td>
            <td class="grand total"></td>
          </tr>
        </tbody>
      </table>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>