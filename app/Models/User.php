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

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

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
        'current_step',
        'landline_number'
    ];

    const REGISTRATION_STEPS = [
        'step_one'  => 'personal_information',
        'step_two'  => 'education_information',
        'step_three'    => 'guardian_and_emergency_contact',
        'step_four'     => 'dikshya_information',
        'step_five'     => 'media_information',
        'step_six'      => 'terms_information',
        'step_seven'      => 'complete',
    ];

    const REGISTRATION_STEP_BACK = [
        'complete'      => 'step_seven',
        'step_seven'    => 'step_six',
        'step_six'      => 'step_five',
        'step_five'     => 'step_four',
        'step_four'     => 'step_three',
        'step_three'    => 'step_two',
        'step_two'      => 'step_one',
        'step_one'      => 'step_one',
    ];

    const USER_ROLES = [
        'user'            => 'User',
        'event_manager'     => 'Event Manager',
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
        'street_address'    =>  'object'
    ];

    protected $with = [
        'getCountry'
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

    public function getUserMeta()
    {
        return $this->hasOne(UserMeta::class, 'user_id');
    }

    public function getUserSadhana()
    {
        return $this->hasMany(UserSadhanaMeta::class, 'user_id');
    }

    public function getCitizenshipCountry()
    {
        return $this->belongsTo(Country::class, 'citizneship_country');
    }
}
