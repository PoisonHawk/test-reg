<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getChildIds(User $user)
    {
        if (!$user->has('childs')) {
            return collect([]);
        }

        $childs = collect([]);

        foreach ($user->childs as $child) {
            $childs = $childs->merge($this->getChildIds($child));
        }

        return $user->childs()->pluck('id')->merge($childs);
    }

    public function getChildUsers(User $user, $paginate = true)
    {
        $query = User::whereIn('id', $this->getChildIds($user))
            ->with('parent')
            ->with('company');

        return $paginate
            ? $query->paginate()
            : $query->get();
    }

    public function registerByUser(User $user, array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'parent_id' => $user->id,
            'company_id' => $user->company_id
        ]);
    }

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if (isset($data['company'])) {
            $company = Company::create([
                'title' => $data['company'],
                'user_id' => $user->id
            ]);

            $user->company_id = $company->id;
            $user->save();
        }

        return $user;
    }
}
