<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { initStore } from '../../../store/StateProducts.vue';



// defineProps({
//     productos: {
//         type: Object,
//     },
// });

// initStore();

const { productos } = defineProps(['productos']);

// console.log({ productos });

// const state = {
//     productos
// }

// console.log(state);

/**
 * Clic a boton nuevo
 */
const newProduct = () => {
    location.href = route('productos.create');
};

/**
 * Formato de moneda
 * @param {Number} number
 * @returns {String} moneda
 */
const formatAsCurrency = (number, currency = 'USD', locale = 'en-US') => {
    return new Intl.NumberFormat(locale, { style: 'currency', currency: currency }).format(number);
};

/**
 * Clic a boton edit
 * @param {Number} id
 */
const editProduct = (id) => {
    location.href = route('productos.edit', id);
};

const form = useForm({
    id: 0,
});

/**
 * Clic a boton edit
 * @param {Number} id
 */
const deleteProduct = (id) => {
    form.id = id;
    form.delete(route('productos.destroy', id), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onFinish: () => location.reload(),
    });
};
</script>
<template>
    <Head title="Productos" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Productos</h2>
        </template>
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4  text-right">
                        <PrimaryButton @click="newProduct">Nuevo</PrimaryButton>
                    </div>
                    <div class="p-4">
                        <!-- Agrega tu tabla aquí -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                    <!-- Agrega más columnas según las propiedades de tu producto -->
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="producto in productos" :key="producto.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ producto.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ formatAsCurrency(producto.price) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <!-- <PrimaryButton @click="editProduct(producto.id)">Edit</PrimaryButton>
                                        <DangerButton @click="deleteProduct(producto.id)" class="ml-1">Delete</DangerButton> -->
                                        <!-- <PrimaryButton @click="showProduct">Edit</PrimaryButton> -->
                                        <PrimaryButton @click="editProduct(producto.id)">Edit</PrimaryButton>
                                        <DangerButton @click="deleteProduct(producto.id)" class="ml-1">Delete</DangerButton>
                                        <!-- <DangerButton @click="confirmDeleteProduct(producto.id)" class="ml-1">Delete</DangerButton> -->
                                    </td>
                                    <!-- Agrega más celdas según las propiedades de tu producto -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- <Modal :show="confirmDeleteProduct" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                        class="mt-1 block w-3/4" placeholder="Password" @keyup.enter="deleteUser" />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="deleteUser">
                        Delete Account
                    </DangerButton>
                </div>
            </div>
        </Modal> -->
    </AuthenticatedLayout>
</template>
