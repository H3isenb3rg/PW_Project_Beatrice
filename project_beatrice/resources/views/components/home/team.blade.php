<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="row" style="margin-bottom: 2em;">
                <div class="col-sm-12">
                    <h2>{{ __("Our Team") }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-xs-6">
                    @include('components.team.teamMember', [
                        'img_src' => 'Giulia.png',
                        'member_name' => 'Giuly',
                        'member_role' => 'Dancer',
                    ])
                </div>
                <div class="col-sm-4 col-xs-6">
                    @include('components.team.teamMember', [
                        'img_src' => 'ADJ.png',
                        'member_name' => 'Arcangelo DJ',
                        'member_role' => 'Frontman',
                    ])
                </div>
                <div class="col-sm-4 col-xs-6">
                    @include('components.team.teamMember', [
                        'img_src' => 'Silvia.png',
                        'member_name' => 'Silvy',
                        'member_role' => 'Dancer',
                    ])
                </div>
                <div class="col-sm-4 col-xs-6">
                    @include('components.team.teamMember', [
                        'img_src' => 'Giulia.png',
                        'member_name' => 'Matteo',
                        'member_role' => 'Lights',
                    ])
                </div>
                <div class="col-sm-4 col-xs-6">
                    @include('components.team.teamMember', [
                        'img_src' => 'Mario.png',
                        'member_name' => 'Mario Broglia DJ',
                        'member_role' => 'Regia',
                    ])
                </div>
                <div class="col-sm-4 col-xs-6">
                    @include('components.team.teamMember', [
                        'img_src' => 'Alice.png',
                        'member_name' => 'Alice',
                        'member_role' => 'Lights & Management',
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
