<template>
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white text-center ">
                    <h1>Crear Estudiantes</h1>
                </div>
                <div class="card-body">
                    <form>
                        <div class="d-grid col-6 mx-auto mb-3">
                            <img v-if="this.foto" :src="this.foto" alt="imagen foto estudiante"
                                class="img-thumbnail custom_img_true">
                            <img v-else src="https://cdn-icons-png.freepik.com/512/7175/7175414.png"
                                alt="imagen foto estudiante" class="img-thumbnail custom_img_false">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input :model="nombre" type="text" placeholder="Nombre Estudiante..." required
                                maxlength="50" class="form-control">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input :model="apellido" type="text" placeholder="Apellido Estudiante..." required
                                maxlength="50" class="form-control">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-gift"></i>
                            </span>
                            <input type="file" accept="image/png, image/jpeg, image/gif" class="form-control">
                        </div>

                        <div class="d-grid col-6 mx-auto mb-3">
                            <button class="btn btn-success">
                                <i class="fa-solid fa-floppy-disk button-save">
                                    Guardar
                                </i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { defineComponent } from 'vue';
    import { CreateStudent } from '@/interfaces/CreateStudent';
    import { Temporal } from 'temporal-polyfill';
    import { confirmButton } from '@/utils/helpers';
    import { ConfirmButtonOptions } from '@/interfaces/ConfirmButtonOptions';
    export default defineComponent({
        data() {
            return {
                createStudent: [] as CreateStudent[],
                loaded: false,
                url: 'http://localhost:8000/api/v1/estudiantes',
            }
        },
        methods: {
            createStudent() {

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
.custom_img_true {
    width: 100px;
}

.custom_img_false {
    max-width: 100%;
    height: 200px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.button-save {
    letter-spacing: 0.06rem;
}
</style>