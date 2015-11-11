<div class="panel panel-border">
    <div class="panel-heading">
        <h3 class="panel-title text-center">Modifier mon profil</h3>
    </div>
    <div class="list-group">
        <a href="{{ route('profile.edit') }}" class="list-group-item{{ Html::isActive('profile.edit', false) }}"><i class="fa fa-wrench"></i> Mon compte</a>
        <a href="{{ route('profile.edit.password') }}" class="list-group-item{{ Html::isActive('profile.edit.password', false) }}"><i class="fa fa-key"></i> Mon mot de passe</a>
        <a href="{{ route('profile.edit.infos') }}" class="list-group-item{{ Html::isActive('profile.edit.infos', false) }}"><i class="fa fa-user"></i> Mes informations</a>
        <a href="#" class="list-group-item"><i class="fa fa-picture-o"></i> Personnaliser mon profil</a>
        <a href="#" class="list-group-item"><i class="fa fa-sitemap"></i> Mes compétences</a>
        <a href="#" class="list-group-item"><i class="fa fa-file-text"></i> Mon Curriculum Vitae</a>
        <a href="#" class="list-group-item"><i class="fa fa-trash"></i> Supprimer mon compte</a>
    </div>
</div>