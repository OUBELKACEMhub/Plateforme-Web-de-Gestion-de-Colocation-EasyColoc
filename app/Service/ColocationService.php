<?php

class ColocationService {
    public function joinNewColocation(User $user, $colocationId) {
        $user->colocations()
             ->wherePivotNull('left_at')
             ->updateExistingPivot($user->activeColocation()->first()->id, [
                 'left_at' => now()
             ]);

        $user->colocations()->attach($colocationId, [
            'joined_at' => now(),
            'role' => 'member'
        ]);
    }
}