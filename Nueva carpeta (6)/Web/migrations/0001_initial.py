# Generated by Django 4.2.7 on 2023-12-02 21:56

from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Usuarios',
            fields=[
                ('ID', models.IntegerField(primary_key=True, serialize=False)),
                ('NOMBRE', models.CharField(max_length=50)),
                ('P_APELLIDO', models.CharField(max_length=50)),
                ('S_APELLIDO', models.CharField(max_length=50)),
                ('USUARIO', models.CharField(max_length=50)),
                ('CORREO', models.CharField(max_length=50)),
                ('CLAVE', models.CharField(max_length=50)),
            ],
        ),
    ]