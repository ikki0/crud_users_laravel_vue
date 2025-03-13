<template>
    <div class="row mt-5">
        <div class="col-lg-8 offset-lg-2">
            <div class="table-responsive">
                <table class="table table-bordered table-hover custom_table">
                    <thead>
                        <tr class="custom_tr">
                            <th>#</th>
                            <th>ID</th>
                            <th>FOTO</th>
                            <th>NOMBRE</th>
                            <th>APELLIDO</th>
                            <th>REGISTRO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="contenido">
                        <tr v-if="!loaded">
                            <td colspan="6" class="">cargando....</td>
                        </tr>
                        <tr v-if="error">
                            <td colspan="6" class="text-danger ">{{ error }}</td>
                        </tr>
                        <tr v-else v-for="(student, i) in students" :key="student.id" class="custom_tr">
                            <td v-text="(i + 1)" class=""></td>
                            <td v-text="student.id" class="" style="height: 100%;"></td>
                            <td class="" style="height: 100%;">
                                <img v-if="student.foto" :src="student.foto" alt="imagen foto estudiante"
                                    class="img-thumbnail custom_img_true">

                                <img v-else src="https://cdn-icons-png.freepik.com/512/7175/7175414.png"
                                    alt="imagen foto estudiante" class="img-thumbnail custom_img_false">
                            </td>
                            <td v-text="student.nombre" class="" style="height: 100%;"></td>
                            <td v-text="student.apellido" class="" style="height: 100%;"></td>
                            <td v-text="Temporal.Instant.from(student.created_at).toLocaleString()" class=""
                                style="height: 100%;">
                            </td>
                            <td class="parent_router">
                                <router-link :to="{ name: 'StudentView', params: { id: student.id } }"
                                    class="btn btn-info">
                                    <i class="fa-solid fa-eye"></i>
                                </router-link>

                                <router-link :to="{ name: 'StudentEdit', params: { id: student.id } }"
                                    class="btn btn-warning">
                                    <i class="fa-solid fa-edit"></i>
                                </router-link>

                                <button v-on:click="deleteStudent(student.id, student.nombre)" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import axios from 'axios';
    import { defineComponent } from 'vue';
    import { Student } from '../interfaces/Student';
    import { Temporal } from 'temporal-polyfill';
    import { confirmButton } from '@/utils/helpers';
    import { ConfirmButtonOptions } from '@/interfaces/ConfirmButtonOptions';
    export default defineComponent({
        data() {
            return {
                students: [] as Student[],
                loaded: false,
                error: null as string | null,
                Temporal: Temporal
            }
        },
        mounted() {
            this.getStudents();
        },
        methods: {
            getStudents() {
                axios.get('http://localhost:8000/api/v1/estudiantes').then(response => {
                    // ... manejar la respuesta
                    this.students = response.data;
                    this.loaded = true;
                }).catch(error => {
                    this.error = 'Error: No se pudo cargar la lista de estudiantes.';
                    console.error(error);
                    this.loaded = true; // Ocultar el mensaje de "cargando..."
                });
            },
            deleteStudent(id: number, name: string) {
                const confirmButtonOptions: ConfirmButtonOptions = this.getDeleteButtonOptions(id, name);
                confirmButton(confirmButtonOptions);
            },

            getDeleteButtonOptions(id: number, name: string): ConfirmButtonOptions {
                return {
                    url: `http://localhost:8000/api/v1/estudiantes/${id}`,
                    method: 'delete',
                    data: {},
                    title: 'Eliminar Registro',
                    message: `Desea eliminar a ${name}?`
                } as ConfirmButtonOptions
            }
        }

    });
</script>

<style scoped>
.custom_table {
    height: 100%;
}

.custom_tr {
    /* border: 1px solid blue; */
    vertical-align: middle;
    text-align: center;
}

.parent_router .btn+.btn {
    margin-left: 8px;
}


.custom_img_true {
    width: 150px;
}

.custom_img_false {
    width: 100px;
}
</style>
