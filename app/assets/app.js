import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/css/app.min.css'
import { prenom } from './js/test.js'

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉')

console.log(prenom);