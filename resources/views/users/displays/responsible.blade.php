@extends('Mobile.layouts.front.app')
@section('title') Stand | @endsection
@section('content')
    @can('Users-Open congregation users')
        <div class="main-content pt-4">
            <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Пользователи</h4>

                            <form action="" method="post">
                                @csrf
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Имя пользователя</th>
                                        <th>Ответственность</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <select name="responsibility[{{ $user->id }}]">
                                                    <option value="option1">Опция 1</option>
                                                    <option value="option2">Опция 2</option>
                                                    <option value="option3">Опция 3</option>
                                                    <!-- Добавьте другие опции по вашему усмотрению -->
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button type="submit">Применить</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
