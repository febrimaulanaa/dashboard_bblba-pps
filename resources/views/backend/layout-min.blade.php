<!DOCTYPE html>
<html>
<head>
    <title>Admin - UT Jakarta</title>
    <style>
        body { font-family: Arial; margin: 0; background: #f5f5f5; }
        .header { background: #006191; color: white; padding: 12px 20px; }
        .header h3 { margin: 0; }
        .nav { background: white; padding: 10px 20px; border-bottom: 1px solid #ddd; }
        .nav a { margin-right: 15px; color: #333; text-decoration: none; }
        .nav a:hover { color: #006191; }
        .content { padding: 20px; }
        .box { background: white; padding: 20px; border-radius: 5px; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background: #006191; color: white; }
    </style>
    @include('partials.analytics')
</head>
<body>
    <div class="header"><h3>Admin UT Jakarta</h3></div>
    <div class="nav">
        <a href="/admin301097">Dashboard</a>
        <a href="/admin301097/pkbjj">PKBJJ</a>
        <a href="/admin301097/osmb">OSMB</a>
        <a href="/admin301097/seminar">Seminar</a>
        <a href="/admin301097/wtku">WTKU</a>
        <a href="/admin301097/wisuda">Wisuda</a>
        <a href="/admin301097/tuweb">Tuweb</a>
        <a href="/admin301097/users">Users</a>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>