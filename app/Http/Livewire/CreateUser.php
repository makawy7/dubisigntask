<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Repositories\UserRepository;
use App\Interfaces\UserRepositoryInterface;

class CreateUser extends Component
{
    use WithFileUploads;
    protected UserRepositoryInterface $userRepository;
    public $successMessage;
    public $username;
    public $email;
    public $bio;
    public $user_type = 'standard';
    public $defaultLat = 31.03892153129559;
    public $defaultLng = 31.3890851898923;
    public $map_location;
    public $date_of_birth;
    protected $listeners = ['mapLocationChanged'];
    public $cert_name;
    public $file;
    public $fileTmpUrl;
    public $file_path;
    public $rules = [
        'user_type' => ['required', 'string', 'in:standard,certified,locationed'],
        'username' => ['required', 'string', 'unique:users,username'],
        'email' => ['required', 'string', 'email', 'unique:users,email'],
        'bio' => ['nullable', 'string'],
        'map_location' => ['nullable', 'required_if:user_type,locationed', 'string'],
        'date_of_birth' => ['nullable', 'required_if:user_type,locationed', 'date'],
        'cert_name' => ['nullable', 'required_if:user_type,certified', 'string'],
        'file' =>  ['nullable', 'required_if:user_type,certified', 'mimes:jpeg,jpg,png,pdf', 'max:10240'],
        'file_path' => ['nullable', 'required_if:user_type,certified', 'string'],
    ];
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->map_location = "{lat: $this->defaultLat, lng: $this->defaultLng}";
    }
    public function render()
    {
        return view('livewire.create-user');
    }
    public function updatedUserName()
    {
        $this->validateOnly('username');
    }
    public function updatedEmail()
    {
        $this->validateOnly('email');
    }
    public function mapLocationChanged($lng, $lat)
    {
        $this->map_location = "{lat: $lat, lng: $lng}";
    }

    public function updatedFile()
    {
        $this->validateOnly('file');
        try {
            $this->fileTmpUrl = $this->file->temporaryUrl();
        } catch (\Exception $e) {
            $this->fileTmpUrl = null;
        }
        $this->file_path = $this->file->store('certifications', 'public');
    }
    public function createUser()
    {
        $this->validate();
        $user = $this->userRepository->createUser([
            'user_type' => $this->user_type,
            'username' => $this->username,
            'email' => $this->email,
            'bio' => $this->bio,
        ]);
        if ($this->user_type === 'locationed') {
            $this->userRepository->attachLocation($user, $this->map_location, $this->date_of_birth);
        }
        if ($this->user_type === 'certified') {
            $this->userRepository->attachCertification($user, $this->cert_name, $this->file_path);
        }
        $this->successMessage = 'User Created Successfully';
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->username = '';
        $this->email = '';
        $this->bio = '';
        $this->fileTmpUrl = '';
        $this->date_of_birth = '';
        $this->cert_name = '';
        $this->file = '';
        $this->file_path = '';
    }
}
