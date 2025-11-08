<?php namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        helper(['form', 'url']);
        return view('auth/register');
    }

    public function registerUser()
{
    $userModel = new UserModel();
    $profilePicture = $this->request->getPost('profile_picture');
    $profileName = null;

    // Save Base64 image (if provided)
    if ($profilePicture && preg_match('/^data:image\/(\w+);base64,/', $profilePicture, $type)) {
        $data = substr($profilePicture, strpos($profilePicture, ',') + 1);
        $type = strtolower($type[1]);
        $data = base64_decode($data);
        $profileName = uniqid() . '.' . $type;
        file_put_contents(FCPATH . 'uploads/profiles/' . $profileName, $data);
    }
   
    $data = [
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
        'email'      => $this->request->getPost('email'),
        'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'dob'        => $this->request->getPost('dob'),
        'gender'     => $this->request->getPost('gender'),
        'address'    => $this->request->getPost('address'),
        'profile_picture' => $profileName,
        'signature'  => $this->request->getPost('signature')
    ];
 log_message('debug', 'Hashed password: ' . password_hash($this->request->getPost('password'), PASSWORD_DEFAULT));

    $userModel->save($data);
    return redirect()->to('/login')->with('success', 'Registration successful!');
}
    
    // Add login and forgot password methods here...
    
    public function login()
    {
        return view('auth/login');
    }

    public function loginUser()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify(trim($password), trim($user['password']))) {
            session()->set(['user' => $user]);
            return redirect()->to('dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
    public function dashboard(){
         if (!session()->has('user')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }
        return view('auth/dashboard');
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function sendResetLink()
    {
    $email = $this->request->getPost('email');
    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('email', $email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'No account found with that email.');
    }

    
    // Generate a token
    $token = bin2hex(random_bytes(16));
    // print_r($user['id']);die;
    $userModel->update($user['id'], ['reset_token' => $token]);

    // In real app: Send email with reset link
    // Example link:
    $resetLink = base_url('reset-password?token=' . $token);

    // For demo
    session()->setFlashdata('success', 'Password reset link: ' . $resetLink);

    return redirect()->back();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    public function resetPassword()
{
    $token = $this->request->getGet('token');

    if (!$token) {
        return redirect()->to('/login')->with('error', 'Invalid or missing token.');
    }

    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('reset_token', $token)->first();

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Invalid or expired token.');
    }

    return view('auth/reset_password', ['token' => $token]);
}

public function handleResetPassword()
{
    $token = $this->request->getPost('token');
    $password = $this->request->getPost('password');
    $confirm = $this->request->getPost('confirm_password');

    if ($password !== $confirm) {
        return redirect()->back()->with('error', 'Passwords do not match.');
    }

    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('reset_token', $token)->first();

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Invalid or expired token.');
    }

    // Update password and clear token
    $userModel->update($user['id'], [
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'reset_token' => null
    ]);

    return redirect()->to('/login')->with('success', 'Password reset successfully. You can now login.');
}

}
