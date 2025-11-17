# Conexión a PostgreSQL de Render desde pgAdmin

## Información de Conexión

Para conectarte a la base de datos de Render desde pgAdmin local, necesitas:

### Opción 1: Desde Render Dashboard


1. Ve a tu base de datos PostgreSQL en Render
2. En la sección "Connections" verás:
   - **External Database URL**: `postgres://usuario:password@host:port/database`
   - O los datos individuales:
     - **Host**: `dpg-xxxxx-a.render.com` (o similar)
     - **Port**: `5432`
     - **Database**: `academias`
     - **User**: `academias_54hx_user`
     - **Password**: `Dh0RypGxzkckl3tkcGEwtdJKkxj7D1Kp`

### Opción 2: Configuración Manual en pgAdmin

1. **Abre pgAdmin**

2. **Clic derecho en "Servers"** → **"Create"** → **"Server..."**

3. **Pestaña "General":**
   - **Name**: `Render PostgreSQL` (o el nombre que prefieras)

4. **Pestaña "Connection":**
   - **Host name/address**: `dpg-xxxxx-a.render.com` (tu host de Render)
   - **Port**: `5432`
   - **Maintenance database**: `academias`
   - **Username**: `academias_54hx_user`
   - **Password**: `Dh0RypGxzkckl3tkcGEwtdJKkxj7D1Kp`
   - ✅ **Save password** (marca esta opción)

5. **Pestaña "SSL":**
   - **SSL mode**: `Require` o `Prefer`
   - (Render requiere SSL para conexiones externas)

6. **Pestaña "Advanced" (opcional):**
   - **DB restriction**: `academias`

7. **Click "Save"**

## Notas Importantes

- ✅ Render requiere **SSL** para conexiones externas
- ✅ El host puede cambiar si recreas la base de datos
- ✅ Verifica que tu IP esté permitida (algunos planes de Render pueden tener restricciones)

## Si no puedes conectarte:

1. Verifica que la base de datos esté activa en Render
2. Revisa que el host y puerto sean correctos
3. Asegúrate de usar SSL mode "Require" o "Prefer"
4. Verifica las credenciales en Render Dashboard

## Ejemplo de External Database URL:

```
postgres://academias_54hx_user:Dh0RypGxzkckl3tkcGEwtdJKkxj7D1Kp@dpg-xxxxx-a.render.com:5432/academias
```

De esta URL puedes extraer:
- **Host**: `dpg-xxxxx-a.render.com`
- **Port**: `5432`
- **Database**: `academias`
- **User**: `academias_54hx_user`
- **Password**: `Dh0RypGxzkckl3tkcGEwtdJKkxj7D1Kp`

