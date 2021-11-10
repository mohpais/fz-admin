<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
    <form class="forms-sample" action="{{route('users.update', $user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="fullname">Fullname</label>
            <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="telp" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="pod">Place of Date</label>
            <input type="text" class="form-control" id="pod" name="pod">
        </div>
        <div class="form-group">
            <label for="bod">Birth of Date</label>
            <input type="text" class="form-control birthday datetimepicker-input" id="bod" name="bod" data-toggle="datetimepicker" data-target=".birthday" autocomplete="off" value="{{$user->bod}}">
        </div>
        <div class="form-group">
            <label for="religion">Religion</label>
            <input type="text" class="form-control" id="religion" name="religion" disabled>
        </div>
        <div class="form-group">
            <label for="marital">Marital Status</label>
            <input type="text" class="form-control" id="marital" name="marital">
        </div>
        <div class="form-group">
            <label for="phone">Open new opportunity</label>
            <select class="form-control" id="status" name="status">
                <option value="0" @php $user->status === 0 ? 'selected="selected"' : '' @endphp>Open</option>
                <option value="1" @php $user->status === 1 ? 'selected="selected"' : '' @endphp>Close</option>
            </select>
        </div>
        <button type="submit" class="col-auto btn btn-gradient-primary mt-3">Update Profile</button>
    </form>
</div>