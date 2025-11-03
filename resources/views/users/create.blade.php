<x-layout title="Novo Usuário">
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="name" class="form-lavel">Nome</label>
            <input type="name" class="form-control" name="name" id="name" />
        </div>

        <div class="form-group">
            <label for="email" class="form-lavel">E-mail</label>
            <input type="email" class="form-control" name="email" id="email" />
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" name="password" id="password"/>
        </div>

        <button class="btn btn-primary mt-3">Registrar</button>
    </form>
</x-layout>
