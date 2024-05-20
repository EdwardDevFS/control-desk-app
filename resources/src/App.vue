<template>
    <section class="w-100 h-100 p-5 flex justify-center">
        <div class="w-[50vw] h-[auto] mt-5 p-5 rounded-md shadow-2xl flex flex-col gap-6">
            <div class="flex w-full items-center gap-4">
                <label for="regani" class="flex-none">REGANI:</label>
                <InputText class="flex-grow min-w-0" type="text" v-model="value" />
                <Button type="button" label="Search" icon="pi pi-search" :loading="loading" @click="load" class="flex-none" />
            </div>
            <div class="flex gap-6">
                <div class="w-[40%]">
                    <UploadFile />
                </div>
                <div class="w-[60%] flex flex-col gap-4">
                    <div class="flex items-center gap-4  w-full">
                        <label for="">GLP:</label>  
                        <AutoComplete 
                            class="w-full p-fluid"
                            v-model="glpValue" 
                            :suggestions="items" 
                            @complete="search" 
                        />
                    </div>
                    <div class="flex items-center gap-4">
                        <label for="">PLU:</label>  
                        <AutoComplete 
                            class="w-full p-fluid" 
                            v-model="pluValue" 
                            :suggestions="items" 
                            @complete="search" />
                    </div>
                    <div class="w-full flex gap-4">
                        <div class="w-2/4 flex items-center gap-4">
                            <label for="">PSO:</label>  
                            <AutoComplete 
                                class="w-full p-fluid" 
                                v-model="pluValue" 
                                :suggestions="items" 
                                @complete="search" 
                            />   
                        </div>
                        <div class="w-2/4 flex items-center gap-4">
                            <label for="">PRE:</label>  
                            <AutoComplete 
                                class="w-full p-fluid" 
                                v-model="pluValue" 
                                :suggestions="items" 
                                @complete="search" 
                            />   
                        </div>
                    </div>
                    <div class="w-full flex gap-4">
                        <div class="w-2/4 flex items-center gap-4">
                            <label for="">DEP:</label>  
                        <AutoComplete 
                            class="w-full p-fluid" 
                            v-model="pluValue" 
                            :suggestions="items" 
                            @complete="search" />   
                        </div>
                        <div class="w-2/4 flex items-center gap-4">
                            <label for="">PIS:</label>  
                        <AutoComplete 
                            class="w-full p-fluid" 
                            v-model="pluValue" 
                            :suggestions="items" 
                            @complete="search" />   
                        </div>
                    </div>
                    <div class="mt-4 flex  justify-end">
                        <Button type="button" label="Add List" severity="success" :loading="loading" @click="load" class="flex-none" />
                    </div>
                </div>      
            </div>
        </div>
    </section>
</template>

<script setup>
// import MultiSelect from 'primevue/multiselect';
import AutoComplete from 'primevue/autocomplete';

import InputText from 'primevue/inputtext';
import UploadFile from './components/UploadFile.vue';
import Button from 'primevue/button';

import { ref } from "vue";

const value = ref("");
const items = ref([]);

const search = (event) => {
    items.value = [...Array(10).keys()].map((item) => event.query);
}
// const selectedCities = ref();
// const cities = ref([
//     { name: 'New York', code: 'NY' },
//     { name: 'Rome', code: 'RM' },
//     { name: 'London', code: 'LDN' },
//     { name: 'Istanbul', code: 'IST' },
//     { name: 'Paris', code: 'PRS' }
// ]);
</script>

<style lang="scss">

</style>