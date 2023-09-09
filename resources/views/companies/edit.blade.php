<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Company') . ': ' . $company->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/companies/edit/{{$company->id}}" method="post">
                        @csrf
                        @method('PATCH')
                        @php
                            $selected_region = $company->locality->region->id;
                            $selected_locality = $company->locality->id;
                        @endphp
                        <div class="mb-6">
                            <label class="block, mb-2 uppercase font-bol text-xs text-gray-700" for="name">Company Name</label>
                            <input 
                            type="text" name='name' value="{{$company->name}}" id='name' required
                            class="border border-gray-400 p-2 w-full"
                            >
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block, mb-2 uppercase font-bol text-xs text-gray-700" for="cif">Fiscal Code</label>
                            <input 
                            type="text" name='cif' id='cif' required
                            value="{{$company->cif}}"
                            class="border border-gray-400 p-2 w-full"
                            >
                            @error('cif')
                                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6 flex flex-col lg:flex-row lg:gap-x-8"
                            x-data="{
                                localities: null,
                                getLocalities(region) {
                                    console.log(region);
                                    fetch('/regions/localities/' + region).then((res) => res.json())
                                    .then((json) =>{
                                         this.localities = json
                                        })
                                }
                            }"
                        x-init="getLocalities({{$selected_region}})">
                            <div class="mb-6">
                                <label class="block mb-2 uppercase font-bol text-xs text-gray-700" for="region">Region</label>
                                <select name="region" x-on:change="getLocalities($event.target.value)" id="region" required>
                                    @php
                                        $regions = \App\Models\Region::all();
                                    @endphp
                                    @foreach ($regions as $region)
                                        <option value="{{$region->id}}" {{$selected_region=== $region->id ? 'selected' : ''}}>{{$region->name}}</option>
                                    @endforeach
                                </select>
                                @error('region')
                                    <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-6">

                                <label class="block mb-2 uppercase font-bol text-xs text-gray-700" for="locality_id">County</label>
                                <select name="locality_id" id="county" required>
                                    <template x-for="county in localities" :key="county.id" >
                                        <option x-bind:value="county.id" x-text="county.name" :selected="county.id === {{$selected_locality}}" ></option>
                                    </template>
                                </select>
                                @error('county')
                                    <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block, mb-2 uppercase font-bol text-xs text-gray-700" for="description">Description</label>
                            <textarea
                            type="text" name='description' id='description'
                            class="border border-gray-400 p-2 w-full"
                            >{{$company->description}}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-400 text-white py-2 px-4 hover:bg-blue-200 hover:text-black rounded-xl">Update Company</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    @if (session()->has('success'))
            <div
            x-data="{show: true}"
            x-init="setTimeout(() => { show = false}, 4000)"
            x-show="show"
            class='fixed right-8 bottom-12 max-w-sm bg-green-400 rounded-full'>
                <p class="text-black text-center px-4 py-2">{{session('success')}}</p>
            </div>
        @endif

</x-app-layout>
