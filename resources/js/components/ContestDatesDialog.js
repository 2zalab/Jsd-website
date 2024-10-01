import React from 'react';
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger } from "@/components/ui/alert-dialog";
import { Button } from "@/components/ui/button";
import { Calendar, Code, Laptop } from 'lucide-react';

const ContestDatesDialog = () => {
  return (
    <AlertDialog>
      <AlertDialogTrigger asChild>
        <Button variant="outline">
          <Calendar className="mr-2 h-4 w-4" />
          Date des concours
        </Button>
      </AlertDialogTrigger>
      <AlertDialogContent className="sm:max-w-[425px]">
        <AlertDialogHeader>
          <AlertDialogTitle className="text-2xl font-bold text-center">Dates des Concours</AlertDialogTitle>
          <AlertDialogDescription className="text-center">
            Découvrez les dates de nos différents concours et inscrivez-vous dès maintenant !
          </AlertDialogDescription>
        </AlertDialogHeader>
        <div className="py-4">
          <div className="space-y-4">
            <div className="flex items-center space-x-4">
              <div className="flex-shrink-0">
                <Laptop className="h-8 w-8 text-blue-500" />
              </div>
              <div>
                <h3 className="text-lg font-semibold">26 novembre</h3>
                <p>Concours des Meilleurs Projets Digital et Hackathon</p>
                <Button variant="outline" size="sm" className="mt-2">
                  S'inscrire
                </Button>
              </div>
            </div>
            <div className="flex items-center space-x-4">
              <div className="flex-shrink-0">
                <Code className="h-8 w-8 text-green-500" />
              </div>
              <div>
                <h3 className="text-lg font-semibold">27 novembre</h3>
                <p>Concours des Meilleurs Programmeurs</p>
                <Button variant="outline" size="sm" className="mt-2">
                  S'inscrire
                </Button>
              </div>
            </div>
          </div>
        </div>
        <AlertDialogFooter>
          <AlertDialogCancel>Fermer</AlertDialogCancel>
          <AlertDialogAction>Voir tous les événements</AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>
  );
};

export default ContestDatesDialog;
