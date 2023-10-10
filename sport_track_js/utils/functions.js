const R = 6378.137; // Rayon de la Terre en km

/**
 * Convertit des degrés en radians.
 * @param {number} degree - Valeur en degré à convertir.
 * @returns {number} L'angle en radians.
 */
function degreeToRadian(degree) {
    return Math.PI * degree / 180;
}

/**
 * Calcule la distance entre deux points GPS.
 * @param {number} lat1 - Latitude du premier point.
 * @param {number} long1 - Longitude du premier point.
 * @param {number} lat2 - Latitude du deuxième point.
 * @param {number} long2 - Longitude du deuxième point.
 * @returns {number} La distance entre les deux points en km.
 */
function calculDistance2PointsGPS(lat1, long1, lat2, long2) {
    lat1 = degreeToRadian(lat1);
    long1 = degreeToRadian(long1);
    lat2 = degreeToRadian(lat2);
    long2 = degreeToRadian(long2);

    return R * Math.acos(Math.sin(lat2) * Math.sin(lat1) + Math.cos(lat2) * Math.cos(lat1) * Math.cos(long2 - long1));
}

/**
 * Calcule la distance totale parcourue lors d'une activité sportive.
 * @param {Object} activite - Objet contenant les détails de l'activité.
 * @returns {number} La distance totale parcourue en km.
 */
function calculDistanceTrajet(activite) {
    let distanceTotale = 0;
    for(let i = 1; i < activite.length; i++) {
        const pointPrecedent = activite[i-1];
        const pointActuel = activite[i];

        distanceTotale += calculDistance2PointsGPS(
            pointPrecedent.latitude, pointPrecedent.longitude,
            pointActuel.latitude, pointActuel.longitude
        );
    }
    return distanceTotale;
}

module.exports = {calculDistanceTrajet};