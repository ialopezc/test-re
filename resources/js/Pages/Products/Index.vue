<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    productos: {
        type: Object,
    },
});

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
                                        <PrimaryButton @click="editProduct(producto.id)">Edit</PrimaryButton>
                                        <DangerButton @click="deleteProduct(producto.id)" class="ml-1">Delete</DangerButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
