<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Pendataan Barang</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('<?=base_url('assets/images/bglebe.png');?>');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container img {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
        }

        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .login-container h1 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #000;
        }

        .login-container p {
            color: #555;
            margin-bottom: 20px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container button {
            background: #D2691E;
            color: #000;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-container button:hover {
            background: #ff9900;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }
        </style>
    </head>

    <body>
        <div class="login-container">
            <img src="<?=base_url('assets/images/lebe.png');?>" alt="lebe.png">
            <h1>SAUNG LEBE</h1>
            <p>Masukkan Akun</p>

            <!-- Tampilkan error jika ada -->
            <?php if (session()->getFlashdata('error')): ?>
            <div class="error"><?=session()->getFlashdata('error');?></div>
            <?php endif;?>

            <form action="<?=base_url('auth/login');?>" method="post">
                <?=csrf_field();?>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>

</html>