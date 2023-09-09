<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full">
                    <div class="controls flex w-full flex-row justify-between">
                        <form action="#" method="get">
                            <input type="search" name="search" value={{request('search')}} class="bg-transparente placeholder-black rounded-xl font-semibold text-sm" placeholder="Search Here" id="">
                        </form>
                        <button class="bg-blue-400 border-2 border-blue-200 border-solid text-white text-sm py-2 px-4 mb-4 rounded-xl hover:bg-blue-600">Add New Company</button></div>
                    {{-- <ul class="flex flex-col flex-nowrap"> --}}
                        <div class="mb-8">{{$companies->links()}}</div>
                        <table class="w-full [&_tr]:mb-2 mt-2 mb-8">
                        <tr class="text-left ">
                            <th>Company Name</th>
                            <th>Fiscal Code</th>
                            <th>Company Locality</th>
                            <th>Company Region</th>
                            <th>Company Description</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($companies as $company )
                            {{-- <li class="company flex flex-row justify-between gap-x-2 p-2 items-center">
                                <div class="data flex grow gap-x-2">
                                    <p>{{$company->name}}</p>
                                    <p>{{$company->locality->name}}</p>
                                    <p>{{$company->locality->region->name}}</p>
                                </div>
                                <div class="buttons gap-x-2 flex flex-row">
                                    <button class="bg-yellow-200 text-black py-2 px-4 rounded-xl hover:bg-yellow-500">Edit</button>
                                    <button class="bg-red-400 text-white py-2 px-4 rounded-xl hover:bg-red-700">Delete</button>
                                </div>
                            </li>      --}}
                            
                            <tr class="">
                                <td><p>{{$company->name}}</p></td>
                                <td><p>{{$company->cif}}</p></td>
                                <td><a class="text-blue-400" href="{{'/localities/'.$company->locality->id}}">{{$company->locality->name}}</a></td>
                                <td><a class="text-blue-400" href="{{'/regions/'.$company->locality->region->id}}">{{$company->locality->region->name}}</a></td>
                                <td><p>{{$company->description}}</p></td>
                                <td>
                                    <div class="buttons gap-x-2 flex flex-row">
                                        <button class="bg-yellow-200 text-black py-2 px-4 rounded-xl hover:bg-yellow-500">Edit</button>
                                        <button class="bg-red-400 text-white py-2 px-4 rounded-xl hover:bg-red-700">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </table>
                        {{$companies->links()}}
                    {{-- </ul> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
