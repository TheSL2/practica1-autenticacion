public function roles()
{
return $this->belongsToMany(Role::class, 'user_roles');
}
public function hasRole($role)
{
return $this->roles->where('name', $role)->isNotEmpty();
}