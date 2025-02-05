<template>
    <div class="max-w-6xl mx-auto p-6">
        <!-- Header -->
        <div class="text-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Laravel 11 Vue JS Vite CRUD (Create Read Update Delete)</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Add Record</h3>
                <form @submit.prevent="save">
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Student Name</label>
                        <input type="text" v-model="student.name"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Student Address</label>
                        <input type="text" v-model="student.address"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Phone</label>
                        <input type="text" v-model="student.phone"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">Save</button>
                </form>
            </div>

            <!-- Table -->
            <div class="md:col-span-2">
                <h2 class="text-xl font-semibold mb-4">Student List</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border rounded-lg shadow-lg">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Student Name</th>
                                <th class="px-4 py-2">Address</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="student in result" :key="student.id" class="border-b">
                                <td class="px-4 py-2">{{ student.id }}</td>
                                <td class="px-4 py-2">{{ student.name }}</td>
                                <td class="px-4 py-2">{{ student.address }}</td>
                                <td class="px-4 py-2">{{ student.phone }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <button
                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition"
                                        @click="edit(student)">Edit</button>
                                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"
                                        @click="remove(student)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Student',
    data() {
        return {
            result: {},
            student: {
                id: '',
                name: '',
                address: '',
                phone: ''


            }
        }
    },
    
    created() {
        this.StudentLoad();
    },

    mounted() {
        console.log("mounted() called.......");
    },

    methods: {
        StudentLoad() {
            var page = "http://127.0.0.1:8000/api/student";
            axios.get(page)
                .then(
                    ({ data }) => {
                        console.log(data);
                        this.result = data;
                    }
                );
        },

        save() {
            if (this.student.id == '') {
                this.saveData();
            }
            else {
                this.updateData();
            }

        },
        
        saveData() {
            axios.post("http://127.0.0.1:8000/api/student", this.student)
                .then(
                    ({ data }) => {
                        alert("saved");
                        this.StudentLoad();
                        this.student.name = '';
                        this.student.address = '',
                            this.student.phone = ''
                        this.id = ''
                    }
                )

        },

        edit(student) {
            this.student = student;
        },

        updateData() {
            var editrecords = 'http://127.0.0.1:8000/api/student/' + this.student.id;
            axios.put(editrecords, this.student)
                .then(
                    ({ data }) => {
                        this.student.name = '';
                        this.student.address = '',
                            this.student.phone = ''
                        this.id = ''
                        alert("Updated!!!");
                        this.StudentLoad();
                    }
                );

        },

        remove(student) {
            var url = `http://127.0.0.1:8000/api/student/${student.id}`;
            // var url = 'http://127.0.0.1:8000/api/student/'+ student.id;
            axios.delete(url);
            alert("Deleted");
            this.StudentLoad();
        }
    }
}

</script>

<style></style>