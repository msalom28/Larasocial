<?php namespace App\Commands;

use App\Events\UserWasRegistered;
use App\User;
use Auth;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterUserCommand extends Command implements SelfHandling
{
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $password_confirmation;
    protected $gender;
    protected $month;
    protected $day;
    protected $year;
    protected $profileimage;
    protected $profileImagePath;
    protected $birthday;

    /**
     * Create a new command instance.
     *
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $password
     * @param $password_confirmation
     * @param $gender
     * @param $month
     * @param $day
     * @param $year
     * @param $profileimage
     * @param $profileImagePath
     * @param $birthday
     */
    public function __construct(
        $firstname,
        $lastname,
        $email,
        $password,
        $password_confirmation,
        $gender,
        $month,
        $day,
        $year,
        $profileimage,
        $profileImagePath,
        $birthday
    )
    {

        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
        $this->gender = $gender;
        $this->month = $month;
        $this->day = $day;
        $this->year = $year;
        $this->profileimage = $profileimage;
        $this->profileImagePath = $profileImagePath;
        $this->birthday = $birthday;
    }

    /**
     * Handle the request
     *
     * @return User $user
     */
    public function handle()
    {
        $user = User::register(
            $this->firstname,
            $this->lastname,
            $this->email,
            bcrypt($this->password),
            $this->gender,
            $this->birthday,
            $this->profileImagePath
        );

        $user->save();

        event(new UserWasRegistered($user));

        Auth::login($user);

        $user->updateOnlineStatus(1);

        return $user;
    }
}