<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f9;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            margin: 30px auto;
            display: flex;
            gap: 20px;
        }

        /* Sidebar */
        .sidebar {
            width: 25%;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .sidebar img {
            border-radius: 50%;
            width: 120px;
            margin-bottom: 15px;
        }

        .sidebar h5 {
            margin-bottom: 5px;
            font-size: 18px;
        }

        .sidebar p {
            font-size: 14px;
            color: gray;
            margin-bottom: 15px;
        }

        .sidebar ul {
            text-align: left;
            margin-bottom: 15px;
        }

        .sidebar ul li {
            margin: 8px 0;
            font-size: 14px;
        }

        .sidebar ul span {
            font-weight: bold;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            border: 1px solid #007bff;
            color: #007bff;
            padding: 8px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .sidebar input {
            width: 100%;
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #f9f9f9;
        }

        /* Content */
        .content {
            width: 75%;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .tabs a {
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            border-bottom: 2px solid transparent;
            margin-right: 10px;
        }

        .tabs a.active {
            border-bottom: 2px solid #007bff;
            color: #007bff;
            font-weight: bold;
        }

        form .row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        form .row .col {
            flex: 1;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #007bff;
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

    </style>
</head>
<body>

<div class="container">
    <!-- Sidebar kiri -->
    <div class="sidebar">
        <img src="https://via.placeholder.com/120" alt="Profile Picture">
        <h5>{{ Auth::user()->name ?? 'Nama User' }}</h5>
        <p>Microsoft Inc.</p>

        <ul>
            <li>Opportunities applied: <span style="color:blue;">32</span></li>
            <li>Opportunities won: <span style="color:green;">26</span></li>
            <li>Current opportunities: <span style="color:black;">4</span></li>
        </ul>

        <a href="#">View Public Profile</a>
        <input type="text" readonly value="https://app.ahrego...">
    </div>

    <!-- Content kanan -->
    <div class="content">
        <div class="tabs">
            <a href="#" class="active">Account Settings</a>
            <a href="#">Company Settings</a>
            <a href="#">Documents</a>
            <a href="#">Billing</a>
            <a href="#">Notifications</a>
        </div>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', 'Nathaniel') }}">
                </div>
                <div class="col">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', 'Poole') }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', '+1800 000') }}">
                </div>
                <div class="col">
                    <label>Email address</label>
                    <input type="email" name="email" value="{{ old('email', 'nathaniel.poole@microsoft.com') }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>City</label>
                    <input type="text" name="city" value="{{ old('city', 'Bridgeport') }}">
                </div>
                <div class="col">
                    <label>State/County</label>
                    <input type="text" name="state" value="{{ old('state', 'WA') }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Postcode</label>
                    <input type="text" name="postcode" value="{{ old('postcode', '31005') }}">
                </div>
                <div class="col">
                    <label>Country</label>
                    <input type="text" name="country" value="{{ old('country', 'United States') }}">
                </div>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</div>

</body>
</html>
