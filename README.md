# 🎬 Filmpedia – Prueba Técnica (WordPress + Tailwind)

Este proyecto consiste en el desarrollo de una página de recomendaciones, maquetada y preparada como un tema de WordPress. Está enfocada a mostrarse en la FrontPage mediante la administración de WordPress con ACF.

---

## 🚀 Tecnologías utilizadas

| Tecnología | Uso |
|------------|-----|
| **Vite** | Entorno de desarrollo frontend para la maquetación |
| **TailwindCSS** | Estilos basados en utilidades |
| **PHP** | Plantillas Wordpress y lógica de ACF |
| **WordPress Studio** | Vista previa funcional |
| **HTML / CSS / JS / PHP** | Estructura y plantillas |
| **VSCode** | IDE recomendado |

## 🌍 Vista Previa Online (WordPress Studio)

**URL:** https://jveigacaminos-gupqm-studio.wp.build/

Esta es la versión funcional del proyecto renderizada en WordPress.  
El evaluador puede navegar y revisar el resultado final sin necesidad de instalar nada en local.

## 📌 Contenido del repositorio
/
├── WordPress-Theme/ # Tema WordPress (para consulta del código .php)
│ ├── assets/
│ ├── header.php
│ ├── front-page.php
│ ├── functions.php
│ └── style.css
├── ViteProject/ # Proyecto principal para desarrollo frontend
├── README.md
└── (otros archivos de soporte)

## 🛠️ Instrucciones para ejecutar el proyecto

Este es el entorno utilizado para maquetar y desarrollar.

### 📌 Requisitos previos
- Node.js 18+
- npm
- Visual Studio Code (recomendado)

### 📌 Instalación
```bash
cd ViteProject
npm install
```

### Ejecutar entorno de desarrollo
npm run dev

## 🧾 Notas y aprendizaje

- El mayor reto fue integrar el diseño con WordPress manteniendo una estructura limpia.
- Se probó inicialmente Docker, pero para la entrega se priorizó una solución más rápida y estable para el evaluador.
- El tema está preparado para poder ampliarse fácilmente con ACF u otras funcionalidades si se continúa el desarrollo.
- Para añadir Docker, se requeriria de docker.compose.yml con la instalación de dependencias, wordpress y funcionalidad para ACF.

---

## ✅ Estado final

- Maquetación lista y funcional
- Tema activable en cualquier instalación WordPress
- Estilos aplicados y fieles al mockup
- Fácil de probar en menos de 1 minuto

---

📌 *Proyecto completado para la prueba técnica.*  
📌 *Cualquier duda o ampliación se puede implementar sobre esta base sin problemas.*
