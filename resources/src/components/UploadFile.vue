<template>
    <div v-if="!imageUploaded" class="flex items-center justify-center cursor-pointer outline-dashed outline-blue-400 w-[100%] h-[400px]" @click="openFilePicker" >
        <div class="flex flex-col justify-center items-center gap-2" @click="openFilePicker">
            <i class="pi pi-image " style="font-size: 2rem; color: var(--primary-color)"></i>
            <p class="text-blue-500 font-bold">Click to upload an image</p>
            <input type="file" ref="fileInput" @change="handleFileChange" accept="image/*" style="display: none;">
        </div>
    </div>
    <div class="w-[100%] h-[400px]"  v-else>
        <div class="min-w-1 max-w-72 h-[315px] border-solid border-2 border-sky-500">
            <img class="w-[100%] h-[100%] object-fill" :src="imageUrl" alt="asdasd">
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const fileInput = ref(null);
const imageUrl = ref(null);
let imageUploaded = ref(false);

const openFilePicker = (event) => {
    event.stopPropagation();
    if (fileInput.value) {
        fileInput.value.click();
    }
};

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    imageUrl.value = URL.createObjectURL(file);
    imageUploaded.value = true;
    // Puedes manejar el archivo aquí, como mostrar una vista previa o subirlo a un servidor
  }
  event.target.value = null;
};
</script>

<style>

</style>