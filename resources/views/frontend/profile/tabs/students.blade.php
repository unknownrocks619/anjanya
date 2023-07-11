<div class="table-bg mtlg-5 mt-3">
    <div class="student-table">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($content as $org_user)
                    <tr>

                        <td>
                            <div class="user w-sm-3">

                                <a href="javascript:void(0)">
                                    <?php
                                    $image = $org_user->getImage;
                                    
                                    if ($image && !is_null($image)) {
                                        $image = $org_user
                                            ->getImage()
                                            ->latest()
                                            ->first();
                                        if ($image) {
                                            $src = \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 's');
                                            echo "<div class='up-image'><img src='{$src}' style='width:80px;height:80px;' /></div>";
                                        } else {
                                            $name = substr($org_user->first_name, 0, 1) . '' . substr($org_user->last_name, 0, 1);
                                            echo "<div class='up-img'>{$name}</div>";
                                        }
                                    } else {
                                        $name = substr($org_user->first_name, 0, 1) . '' . substr($org_user->last_name, 0, 1);
                                        echo "<div class='up-img'>{$name}</div>";
                                    }
                                    
                                    ?>
                                </a>


                                <div class="user-detail">
                                    <div class="name">{{ $org_user->getFullName() }}</div>
                                    <div class="email student-p">
                                        {{ $org_user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user w-sm-3">
                                <div class="user-detail">
                                    <div class="name">Recent Course</div>
                                    <div class="email student-p">
                                        {{ $org_user->getLatestCourse?->getCourse->course_name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if ($org_user->getLatestCourse)
                                <?php
                                $percentage = 0;
                                $totalCount = $org_user->getLatestCourse->getCourse->lessions->count();
                                $totalWatchCount = $org_user->getLatestCourse
                                    ->getHistory()
                                    ->where('completed', true)
                                    ->count();
                                
                                // $percentage = 0;
                                
                                if ($totalWatchCount) {
                                    $percentage = ($totalWatchCount / $totalCount) * 100;
                                }
                                
                                ?>
                                <div class="student-bar w-sm-3">
                                    <div class="progress mb-2">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%"
                                            aria-valuenow="{{ $totalWatchCount }}" aria-valuemin="0"
                                            aria-valuemax="{{ $totalCount }}"></div>
                                    </div>
                                    <div class="student-p">
                                        {{ $org_user->getLatestCourse->getHistory()->where('completed', true)->count() }}/{{ $org_user->getLatestCourse->getCourse->lessions->count() }}
                                        Lessons Completed</div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
