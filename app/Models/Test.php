<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class Test extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    protected $connection = 'wpmysql';

    protected $table = 'wp_posts';
    const ALLOW_LOGIN = 'active';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'country',
        'state',
        'street_address',
        'date_of_birth',
        'gender',
        'phone_number',
        'source',
        'source_id',
        'source_records',
        'username',
        'status',
        'email',
        'password',
        'role',
        'invite_token',
        'current_step'
    ];

    const REGISTRATION_STEPS = [
        'step_one'  => 'account_information',
        'step_two'  => 'basic_info',
        'step_three'    => 'canva_account',
        'step_four'     => 'confirmation',
        'complete'      => 'complete'
    ];


    const USER_ROLES = [
        'parent'            => 'Parent of Student',
        'student_under'     => 'Student Under 18',
        'student_above'     => 'Student Above 18',
        'teacher'           => 'Teacher'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'email',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' =>  'datetime',
        'source_record'     =>  'object',
        'phone_number'      =>  'encrypted',
        'gender'            =>  'encrypted',
        'date_of_birth'     =>  'encrypted',
        'street_address'    =>  'object'
    ];


    public static function seperateFullName(string $fullname): array
    {
        $name = [
            'first_name'    => '',
            'middle_name'   => '',
            'last_name'     => ''
        ];
        $seperateName = explode(' ', $fullname);

        $name['first_name'] = $seperateName[0];

        if (count($seperateName) > 2) {
            $name['middle_name'] = $seperateName[1];
            for ($i = 1; $i >= (count($seperateName) - 1); $i++) {
                $name['last_name'] = $name['last_name'] . ' ' . $seperateName[$i];
            }
        } else {
            $name['middle_name']     = '';
            $name['last_name'] = isset($seperateName[1]) ? $seperateName[1] : '';
        }
        return $name;
    }

    public function getFullName()
    {
        $fullname = $this->first_name;

        if ($this->middle_name) {
            $fullname .= ' ' . $this->middle_name;
        }

        $fullname .= ' ' . $this->last_name;

        return $fullname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUserStatus()
    {
        $class = ' ';
        if ($this->status == 'active') {
            $class = 'badge rounded-pill badge-success';
        } elseif ($this->status == 'suspend' || $this->status == 'review') {
            $class = 'badge rounded-pill badge-warning';
        } elseif ($this->status == 'hold') {
            $class = 'badge rounded-pill badge-info';
        } else {
            $class = 'badge rounded-pill badge-danger';
        }

        return "<span class='{$class}'>" . ucwords($this->status) . "</span>";
    }

    /**
     * Get Country Name
     *
     * @return BelongsTo
     *
     */
    public function getCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function getUserCanva(): HasOne
    {
        return $this->hasOne(CanvaRegistration::class, 'user_id');
    }

    public function getImage()
    {
        return $this->hasMany(FileRelation::class, 'relation_id')->where('relation', User::class);
    }

    public function getOrganisation()
    {
        return $this->hasOne(OrganisationStudent::class, 'user_id');
    }

    public function getLatestCourse()
    {
        return $this->hasOne(UserCourseEnrollment::class, 'user_id')->orderBy('id', 'desc');
    }

    public function getSeo()
    {
        return $this->hasOne(SeoRelation::class, 'relation_id')->where('relation', User::class);
    }

    public function getBooks()
    {
    }

    public function getDonations()
    {
    }

    public function getPurchaseOrders()
    {
    }

    public static function check_username($username, User $user = null): bool
    {

        $userQuery = User::where('username', $username);

        if ($user) {
            $userQuery->where('id', '!=', $user->getKey());
        }

        if ($userQuery->exists()) {
            return false;
        }

        return true;
    }

    public static function countByRole()
    {
        $sql = 'SELECT role, COUNT(DISTINCT id) AS total_students, COUNT(*) AS total_records
        FROM users
        where current_step = "complete"
        GROUP BY role WITH ROLLUP';

        $query = <<<SQL
        $sql
        SQL;
        return DB::select($query);
    }
}
