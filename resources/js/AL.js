function calculateGravityForce(mass, gravity = 9.81) {
    return mass * gravity;
}


function calculateBuoyantForce(density, submergedVolume, gravity = 9.81) {
    return density * submergedVolume * gravity;
}


function calculateSegmentArea(radius, submergedHeight) {
    const r = radius;
    const h = submergedHeight;
    return r * r * Math.acos((r - h) / r) - (r - h) * Math.sqrt(2 * r * h - h * h);
}


function calculateSubmergedVolumeForCylinder(radius, submergedHeight, length) {
    const segmentArea = calculateSegmentArea(radius, submergedHeight);
    return segmentArea * length;
}


function calculateNetForce(gravityForce, buoyantForce) {
    return buoyantForce - gravityForce;
}
