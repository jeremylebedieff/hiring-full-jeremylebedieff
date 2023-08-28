#!/bin/bash

function create_fleet() {
  local user_id="$1"
  local fleet_id="$(uuidgen)"
  echo "Fleet created with ID $fleet_id for user $user_id"
}

function register_vehicle() {
  local fleet_id="$1"
  local vehicle_plate_number="$2"
  echo "Vehicle with plate number $vehicle_plate_number registered to fleet $fleet_id"
}

function localize_vehicle() {
  local fleet_id="$1"
  local vehicle_plate_number="$2"
  local lat="$3"
  local lng="$4"
  local alt="${5:-0}"
  echo "Vehicle with plate number $vehicle_plate_number in fleet $fleet_id is now at location ($lat, $lng, $alt)"
}

if [ "$1" = "create" ]; then
  create_fleet "$2"
elif [ "$1" = "register-vehicle" ]; then
  register_vehicle "$2" "$3"
elif [ "$1" = "localize-vehicle" ]; then
  localize_vehicle "$2" "$3" "$4" "$5" "$6"
else
  echo "Invalid command. Usage: "
  echo "./fleet create <userId>"
  echo "./fleet register-vehicle <fleetId> <vehiclePlateNumber>"
  echo "./fleet localize-vehicle <fleetId> <vehiclePlateNumber> lat lng [alt]"
fi

