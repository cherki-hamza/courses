<div>
    {{-- The Master doesn't talk, he acts. --}}
    <h4 class="text-danger">This is from Livwire Dev Component</h4>
    <p>
        <span wire:click="Increment" class="btn btn-primary text-left">+</span>

        <span wire:click="Decrement" style="float: right" class="btn btn-danger text-right">-</span>
    </p>
    <br><br>
    <h5 style="font-size: 30px" class="text-info text-center">{{ $count }}</h5>
    <br><br>

    <div class="card">
        <div class="form-group">
            <label for="searsh">searsh</label>
            <input wire:model="searsh" type="text"  placeholder="searsh User">
        </div>

        <div class="form-group">
            <ul class="form-items">
               @foreach ($users as $user)
                 <a href="?username={{ $user->name }}"><li>{{ $user->name }}</li></a>
                 <li>{{ $user->email }}</li>
                 <li>{{ $user->created_at }}</li>
               @endforeach
            </ul>
        </div>
    </div>
</div>
