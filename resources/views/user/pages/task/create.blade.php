@extends('user.layouts.master')
@extends('user.layouts.header')
@section('title')
{{ $title ??'Add task' }}
@endsection

@section('content')

<div class="formdiv">
          <form action="{{route('task.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h1>Create Task</h1>
                    <hr>

                    <label for="project_id"><b>Project Id</b></label>
                    <input type="text" pattern="PRJ_[A-Z]{6}|PRJ_[0-9]{6}" placeholder="Example PRJ_ADCDEF"
                              name="project_id" id="project_id" required>

                    <label for="task_type"><b>Task Type</b></label>
                    @foreach($taskTypes as $taskType)
                    <div class="form-check">
                              <input class="form-check-input" type="radio" name="type_id" value={{$taskType->id}}
                              required>
                              <label class="form-check-label" for="flexRadioDefault1">
                                        {{$taskType->type}}
                              </label>
                    </div>
                    @endforeach

                    <div>
                              <label for="file"><b>Input File</b></label>
                              <input type="file" accept=".txt" class="form-control form-control-lg" name="file" required
                                        id="password">
                              <span class="text-muted">Allow formats: .txt</span>
                    </div>

                    <button type="submit" class="actionbtn">Create</button>
          </form>

</div>

@endsection