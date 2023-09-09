<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/companies" method="post">
                        @csrf

                        <div class="mb-6">
                            <label class="block, mb-2 uppercase font-bol text-xs text-gray-700" for="name">Company Name</label>
                            <input 
                            type="text" name='name' id='name' required
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
                        x-init="getLocalities(1)">
                            <div class="mb-6">
                                <label class="block mb-2 uppercase font-bol text-xs text-gray-700" for="region">Region</label>
                                <select name="region" x-on:change="getLocalities($event.target.value)" id="region" required>
                                    @php
                                        $regions = \App\Models\Region::all();
                                    @endphp
                                    @foreach ($regions as $region)
                                        <option value="{{$region->id}}">{{$region->name}}</option>
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
                                        <option x-bind:value="county.id" x-text="county.name"></option>
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
                            ></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-400 text-white py-2 px-4 hover:bg-blue-200 hover:text-black rounded-xl">Publish Company</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            // const regions = document.getElementById('region');
    
            console.log('hello');
    
            // regions.addEventListente('change', (e) => {
            //     console.log(e);
            // });
    
            // const getLocalities = async () => {
            //     const localities = await fetch('/regions/localities')
            // }
        <script>
    </div>

</x-app-layout>
