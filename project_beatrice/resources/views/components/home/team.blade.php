<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="row" style="margin-bottom: 2em;">
                <div class="col-sm-12">
                    <h2>{{ __("Our Team") }}</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($teamMembers as $member)
                    <div class="col-sm-4 col-xs-6">
                        @include('components.team.teamMember', [
                            'img_src' => $member->image,
                            'member_name' => $member->name,
                            'member_role' => $member->role,
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
